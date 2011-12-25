#!/bin/sh
#
# DBLess permissions setup
#

if [[ $(whoami) != "root" ]]
then
  echo "This actions must be done as root. Invoking sudo"
  PREFIX="sudo"
fi


PERMS_DIR="775"
PERMS_DIR_ALL="777"
#PERMS_FILE="644"
OWNER="nobody"
GROUP="nobody"

function set_perms_dir
{
    if [[ "${1}" = "all" ]]; then
        ${PREFIX} chown -R ${OWNER}:${GROUP}  ${2} ${3} ${4} ${5}
        ${PREFIX} chmod -R ${PERMS_DIR_ALL} ${2} ${3} ${4} ${5}
    else
        ${PREFIX} chown -R ${OWNER}:${GROUP} ${2} ${3} ${4} ${5}
        ${PREFIX} chmod -R ${PERMS_DIR} ${2} ${3} ${4} ${5}
    fi
}

#function set_perms_file
#{
#  ${PREFIX} chown -R ${OWNER}:${GROUP} ${1} ${2} ${3} ${4}
#  ${PREFIX} chmod -R ${PERMS_FILE} ${1} ${2} ${3} ${4}
#}


set_perms_dir norm info/
set_perms_dir norm rss/
set_perms_dir norm users/
set_perms_dir norm posts/
set_perms_dir all smarty/cache smarty/compile smarty/templates_c


echo "Done!"

