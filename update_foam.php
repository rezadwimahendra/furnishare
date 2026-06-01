<?php
$products = App\Models\Product::whereHas('category', function($q) { 
    $q->whereIn('slug', ['kursi', 'sofa']); 
})->get(); 
foreach($products as $p) { 
    $opts = $p->custom_options; 
    $opts['foam_colors'] = [
        ['name' => 'Putih Tulang', 'value' => '#F8F6F0'],
        ['name' => 'Hitam Karbon', 'value' => '#1A1A1A'],
        ['name' => 'Kelabu Asap', 'value' => '#8E9092']
    ]; 
    $p->update(['custom_options' => $opts]); 
}
echo 'Sukses update foam_colors!';
