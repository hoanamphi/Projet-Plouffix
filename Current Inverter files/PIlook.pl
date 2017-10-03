#########################  The PI engine  ##########################
#  Written 08/11/96, Paul Irvine
#  Updated 12/02/96, Paul Irvine
#  Change le 6 mars 1998, Simon Plouffe
#####################################################################

sub A_filter {
  my($in) = @_;
  my($n) = index($in, "A0");
  my($Apart, $URL);

  if ($n < 0) { return $in; }
  else {
    $Apart = substr($in, $n, 7);
    $URL =
"<A HREF=http://www.research.att.com:80/cgi-bin/access.cgi/as/njas/sequences/eisA.cgi?Anum=$Apart>";
    return join "", substr($in, 0, $n), $URL, $Apart, "</A>", substr($in, $n+7); }

  return $in; }
  
#####################################################################
#
# lookPI -- returns an array of matches to $key in the PI
#         -- output format: "value~Rcode~description"
#
#####################################################################

sub lookPI {
  my($key) = @_;
  my($prefix1) = substr($key, 0, 2);
  my($prefix2) = substr($key, 0, 4);
  my($suffix) = substr($key, 4, 12);
  my($filename) = "/plouffe/IP/$prefix1/a$prefix2";
  my(@return, $descr);

  if (length($key) > 4) {
    open(ISCHANDLE, $filename) || die "Can't find $filename.";
    &look(*ISCHANDLE, $suffix);
    while (<ISCHANDLE>) {
      last unless /^$suffix/;
      chop;
      $descr = &A_filter(substr($_, 16));
      push @return, [$prefix2.substr($_,0, 12), substr($_, 12, 4), $descr];
    }
  }
  @return;
}

#####################################################################
#
# lookPIn -- returns an array of matches to $key in the *integer* PI
#          -- output format: "value~Rcode~description"
#
#####################################################################

sub lookPIn {
  my($key) = @_;
  my($len) = length($key);
  my($filename) = "/plouffe/IP/N$len";
  my(@return, $descr);

  if ($len > 3) {
    open(ISCHANDLE, $filename) || die "Can't find $filename.";
    &look(*ISCHANDLE, $key);
    while (<ISCHANDLE>) {
      last unless /^$key/;
      chop;
      $descr = &A_filter(substr($_, $len + 4));
      push @return, [substr($_, 0, $len), substr($_, $len, 4), $descr];
    }
  }
  @return;
}  

#####################################################################
#
# countPI -- returns the number of matches to $key in the PI
#
#####################################################################

sub countPI {
  my($key) = @_;
  my($prefix1) = substr($key, 0, 2);
  my($prefix2) = substr($key, 0, 4);
  my($suffix) = substr($key, 4, 12);
  my($filename) = "/plouffe/IP/$prefix1/a$prefix2";
  my($return) = 0;

  if (length($key) > 4) {
    open(ISCHANDLE, $filename) || die "Can't find $filename.";
    &look(*ISCHANDLE, $suffix);
    while (<ISCHANDLE>) {
      last unless /^$suffix/;
      $return ++;
    }
  }
  $return;
}

#####################################################################
#
# countPIn -- returns the number of matches to $key in the *integer* PI
#
#####################################################################

sub countPIn {
  my($key) = @_;
  my($len) = length($key);
  my($filename) = "/plouffe/IP/N$len";
  my($return) = 0;

  if ($len > 3) {
    open(ISCHANDLE, $filename) || die "Can't find $filename.";
    &look(*ISCHANDLE, $key);
    while (<ISCHANDLE>) {
      last unless /^$key/;
      $return ++;
    }
  }
  $return;
}  

#####################################################################
#
# browsePI -- returns an array of the closest $size * 2 entries to $key
#                in the PI
#           -- output format: "value~Rcode~description"
#
#####################################################################

sub browsePI {
  my($key, $size, $page_no) = @_;
  my($prefix1) = substr($key, 0, 2);
  my($prefix2) = substr($key, 0, 4);
  my($suffix) = substr($key, 4, 12);
  my($filename) = "/plouffe/IP/$prefix1/a$prefix2";
  my($linesize) = 45;
  my($page_ratio) = 1.6;
  my($dec) = $size * 2;
  my(@return, $descr);

  if (length($key) > 4) {
    open(ISCHANDLE, $filename) || die "Can't find $filename.";
    &look(*ISCHANDLE, $suffix);
    seek(ISCHANDLE, ($page_ratio * $page_no - 1) * $size * $linesize, 1);
    <ISCHANDLE> if tell(ISCHANDLE);
    while (<ISCHANDLE>) {
      $dec --;
      last if ($dec < 0);
      chop;
      $descr = &A_filter(substr($_,16));
      push @return, [$prefix2.substr($_,0, 12), substr($_, 12, 4), $descr];
    }
  }
  @return;
}  

#####################################################################
#
# browsePIn -- returns an array of the closest $size * 2 entries to $key
#                in the integer portion of the PI
#           -- output format: "value~Rcode~description"
#
#####################################################################

sub browsePIn {
  my($key, $size, $page_no) = @_;
  my($len) = length($key);
  my($filename) = "/plouffe/IP/N$len";
  my($linesize) = 18 + $len;
  my($page_ratio) = 1.6;
  my($dec) = $size * 2;
  my(@return, $descr);

  if (length($key) > 3) {
    open(ISCHANDLE, $filename) || die "Can't find $filename.";
    &look(*ISCHANDLE, $key);
    seek(ISCHANDLE, ($page_ratio * $page_no - 1) * $size * $linesize, 1);
    <ISCHANDLE> if tell(ISCHANDLE);
    while (<ISCHANDLE>) {
      $dec --;
      last if ($dec < 0);
      chop;
      $descr = &A_filter(substr($_,$len+4));
      push @return, [substr($_, 0, $len), substr($_, $len, 4), $descr];
    }
  }
  @return;
}  

## The following piece of code was stolen from the file "look.pl", one
##   of the standard Perl libraries.

sub look {
    local(*FH,$key) = @_;
    my($max,$min,$mid);
    local($_);
    my($dev,$ino,$mode,$nlink,$uid,$gid,$rdev,$size,$atime,$mtime,$ctime,
       $blksize,$blocks) = stat(FH);
    $blksize = 8192 unless $blksize;
    $max = int($size / $blksize);
    while ($max - $min > 1) {
        $mid = int(($max + $min) / 2);
        seek(FH,$mid * $blksize,0);
        $_ = <FH> if $mid;              # probably a partial line
        $_ = <FH>;
        chop;
        if ($_ lt $key) {
            $min = $mid;
        }
        else {
            $max = $mid;
        }
    }
    $min *= $blksize;
    seek(FH,$min,0);
    <FH> if $min;
    while (<FH>) {
        chop;
        last if $_ ge $key;
        $min = tell(FH);
    }
    seek(FH,$min,0);
    $min;
}

1;
