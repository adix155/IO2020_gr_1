function yi = interp1q (x, y, xi)

  persistent warned = false;
  if (! warned)
    warned = true;
    warning ("Octave:deprecated-function",
             "interp1q is obsolete and will be removed from a future version of Octave; use interp1 instead");
  endif

  x = x(:);
  nx = rows (x);
  szy = size (y);
  y = y(:,:);
  [ny, nc] = size (y);
  szx = size (xi);
  xi = xi (:);
  dy = diff (y);
  dx = diff (x);
  idx = lookup (x, xi, "lr");
  s = (xi - x (idx)) ./ dx (idx);
  yi = bsxfun (@times, s, dy(idx,:)) + y(idx,:);
  range = xi < x(1) | !(xi <= x(nx));
  yi(range,:) = NA;
  if (length (szx) == 2 && any (szx == 1))
    yi = reshape (yi, [max(szx), szy(2:end)]);
  else
    yi = reshape (yi, [szx, szy(2:end)]);
  endif
endfunction
