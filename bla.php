<?php

// get all pictures of an ebay-kleinanzeigen ad

if (empty($_GET['link'])) {
    ?>
    <form>
        <input type="text" name="link" />
        <button type="submit">link</button>
    </form>
    <?php
} else {
    $link = $_GET['link'];

    $doc = new DOMDocument;
    @$doc->loadHTMLFile($link);

    $xpath = new DomXPath($doc);
    $nodes = $xpath->query("//ul[@id='viewad-lightbox-thumbnail-list']/li/div[@class='imagebox-thumbnail']/img");

    foreach ($nodes as $node) {
        foreach ($node->attributes as $attribute) {
            if ($attribute->name == 'data-imgsrc') {
                ?>
                <a href="<?=$attribute->value?>"><img src="<?=$attribute->value?>" /></a>
                <br />
                <br />
                <br />
                <?php
                break;
            }
        }
    }
}
