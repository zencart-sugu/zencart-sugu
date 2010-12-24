// xGetElementById r2, Copyright 2001-2007 Michael Foster (Cross-Browser.com)
// Part of X, a Cross-Browser Javascript Library, Distributed under the terms of the GNU LGPL
function xGetElementById(e)
{
    if (typeof(e) == 'string') {
	if (document.getElementById) e = document.getElementById(e);
	else if (document.all) e = document.all[e];
	else e = null;
    }
    return e;
}

// xAddEventListener r8, Copyright 2001-2007 Michael Foster (Cross-Browser.com)
// Part of X, a Cross-Browser Javascript Library, Distributed under the terms of the GNU LGPL
function xAddEventListener(e,eT,eL,cap)
{
    if(!(e=xGetElementById(e)))return;
    eT=eT.toLowerCase();
    if(e.addEventListener)e.addEventListener(eT,eL,cap||false);
    else if(e.attachEvent)e.attachEvent('on'+eT,eL);
    else {
	var o=e['on'+eT];
	e['on'+eT]=typeof o=='function' ? function(v){o(v);eL(v);} : eL;
    }
}

function setColor(e) {
  var target = e.target;

  while (target.tagName != 'TR') {
    target = target.parentNode;
  }

  target.backup = target.style.backgroundColor;
  target.style.backgroundColor = '#FF0000';
  if (target.sib) {
    target.sib.backup = target.sib.style.backgroundColor;
    target.sib.style.backgroundColor = '#FF0000';
  }
}
function reverseColor(e) {
  var target = e.target;

  while (target.tagName != 'TR') {
    target = target.parentNode;
  }

  target.style.backgroundColor = target.backup;
  if (target.sib) {
    target.sib.style.backgroundColor = target.sib.backup;
  }
}
function linkTo(e) {
  var target = e.target;

  while (target.tagName != 'TR') {
    target = target.parentNode;
  }

  window.location.href = target.href;
}

function eventListener() {
  var table = xGetElementById('catTable');
  var tr = table.getElementsByTagName('tr');

  var targets = new Array();
  var i = 1;
  var j = tr.length;
  for (; i < j; i = i + 2) {
    tr[i].href = tr[i].getElementsByTagName('a')[0].href;
    tr[i].sib = tr[i+1];
    tr[i].style.cursor = 'pointer';
    tr[i+1].href =  tr[i].getElementsByTagName('a')[0].href;
    tr[i+1].sib = tr[i];
    tr[i+1].style.cursor = 'pointer';
    targets.push({tr1: tr[i], tr2: tr[i+1]});
  }

  var i = 0;
  var j = targets.length;
  for (; i < j; i++) {
    xAddEventListener(targets[i].tr1, 'mouseover', setColor, false);
    xAddEventListener(targets[i].tr2, 'mouseover', setColor, false);
    xAddEventListener(targets[i].tr1, 'mouseout', reverseColor, false);
    xAddEventListener(targets[i].tr2, 'mouseout', reverseColor, false);
    xAddEventListener(targets[i].tr1, 'click', linkTo, false);
    xAddEventListener(targets[i].tr2, 'click', linkTo, false);
  }
}

xAddEventListener(window, 'load', eventListener, false);
