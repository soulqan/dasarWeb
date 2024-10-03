<?php
$loremIpsum = "Lorem ipsum dolor sit amet consectetur adipisicing elit. 
        Nihil quae error soluta veniam repellat nam magni ut perspiciatis voluptatem cum, 
        illo quas impedit asperiores pariatur amet alias obcaecati odio tempore!";


echo "<p>{$loremIpsum}</p>";
echo "Panjang karakter: " . strlen($loremIpsum) . "<br>";
echo "Panjang kata: " . str_word_count($loremIpsum) . "<br>";
echo "<p>" . strtoupper($loremIpsum) . "</p>";
echo "<p>" . strtolower($loremIpsum) . "</p>";
?>
