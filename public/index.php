<img src="logo-dark.svg" alt="logo">

<h1>Productoverzicht</h1>

<button type="submit" onclick="importProducts()">refresh</button><br><br>

<?php
    $products = include 'select_products.php';

    if (!empty($products)) {
        echo '<table border="1" cellpadding="10" cellspacing="0">';
        echo '<thead>';
        echo '<tr>';
        echo '<th>Titel</th>';
        echo '<th>Prijs (€)</th>';
        echo '<th>Prijs incl. korting (€)</th>';
        echo '<th>Brand</th>';
        echo '<th>Categorie</th>';
        echo '<th>Thumbnail</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';
    
        foreach ($products as $product) {
            $discountedPrice = $product['price'] - ($product['price'] * ($product['discountPercentage'] / 100));
            echo '<tr>';
            echo '<td>' . htmlspecialchars($product['title']) . '</td>';
            echo '<td>€ ' . htmlspecialchars(number_format($product['price'], 2)) . '</td>';
            echo '<td>€ ' . htmlspecialchars(number_format($discountedPrice, 2)) . '</td>';
            echo '<td>' . htmlspecialchars($product['brand'] ?? 'NA') . '</td>';
            echo '<td>' . htmlspecialchars($product['category']) . '</td>';
            echo '<td><img src="' . htmlspecialchars($product['thumbnail']) . '" alt="' . htmlspecialchars($product['title']) . '" style="width:100px; height:auto;"></td>';
            echo '</tr>';
        }
    
        echo '</tbody>';
        echo '</table>';
    } else {
        echo "<p>Geen producten gevonden.</p>";
    }
    ?>

<script>
    function importProducts() {
        fetch('import_products.php', {
            method: 'POST'
        })
        .then(response => response.text())
        .then(data => {
            alert('Products imported successfully!');
            console.log(data);
            location.reload();
        })
        .catch(error => {
            alert('An error occurred while importing products.');
            console.error('Error:', error);
        });
    }
</script>