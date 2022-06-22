tag=$(git describe --tags --abbrev=0)

tag=$( echo $tag | sed -e 's/\.//g' )
tag=$( echo $((tag+1)) )

if [ $((3 > ${#tag})) ]; then
    z="0"
    tag=${z}${tag}

    if [ $((3 > ${#tag})) ]; then
        tag=${z}${tag}
    fi
fi


new=""
for (( i=0; i<3; i++ )); 
do
    dot="."
    num=${tag:$i:1}

    if [ $i != 0 ]; then
        new="${new}${dot}${num}"
    else
        new="${new}${num}"
    fi
done

echo $new