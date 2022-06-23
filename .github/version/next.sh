tag=$(git describe --tags --abbrev=0)

tag=$( echo $tag | sed -e 's/\.//g' )
tag=$(($tag + 1))

new=$tag
while ((3 > ${#new})); do
      z="0"
      new=${z}${new};
done

version=
for (( i=0; i<3; i++ )); 
do
    dot="."
    num=${new:$i:1}

    if [ $i != 0 ]; then
        version="${version}${dot}${num}"
    else
        version="${version}${num}"
    fi
done

echo $version