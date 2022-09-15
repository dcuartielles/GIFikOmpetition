#!/bin/bash
## call this script with ./generateThumbnails.sh ../docs/202209/images 200
## parameters:
## -1 folder where to look for images
## -2 final size [width]x[height], i.e. 400x300
my_path=$1
all_files=$( find $my_path -type f -name '*.jpg' -o -name '*.jpeg' -o -name '*.png' -o -name '*.gif' )
current_path="$(pwd)"
cd $my_path;
cd ..;
mkdir thumbnails;
while read line
do
	filename=$(basename -- "$line")
	extension="${filename##*.}"
	name="${filename%.*}"
    	echo "About to convert $name of type $extension ..."
	if [ "$extension" = "gif" ]; then
    		gifsicle $current_path/$line --resize-fit-width $2 > ./tmp_image && cat ./tmp_image > thumbnails/$name.$extension
	else
		convert $current_path/$line -resize $2 thumbnails/$name.$extension
	fi
    	echo "* finished: $line"
done <<< "$all_files"
rm ./tmp_image
echo "* Done! *"
