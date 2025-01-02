#!/usr/bin/env bash

name="Vivaldi"
wid=$(xdotool search --onlyvisible --name "${name}" | head -1)

if [ -n "${wid}" ]; then
	xdotool windowactivate "${wid}"
	xdotool key 'ctrl+r'
	exit 0
fi

browser="vivaldi"
url='http://localhost/imerologio/index.php?dummy'

debug="debug"
debug=

etos=2020
etos=

[ -n "${debug}" ] && url="${url}&${debug}"
[ -n "${etos}" ] && url="${url}&etos=${etos}"

${browser} "${url}" &
wid=$(xdotool search --onlyvisible --name "${name}" | head -1)

[ -n "${wid}" ] &&
xdotool windowfocus "${wid}"

exit 0
