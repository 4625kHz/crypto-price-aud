<?php

function current_price($coin) {
	$url = "https://api.binance.com/api/v3/ticker/price?symbol=" . $coin ."AUD";

	// Coin/AUD pair traded on Binance exchange
	if ($json_data = file_get_contents("$url")) {
		$json_array = json_decode($json_data, true);
		$curr_price = $json_array["price"]; 
	}

	// Coin/AUD pair not traded on Binance exchange
	else {
		$url = "https://api.binance.com/api/v3/ticker/price?symbol=AUDUSDT";
		$json_data = file_get_contents("$url");
		$json_array = json_decode($json_data, true);
		$ex_rate = $json_array["price"];

		$url = "https://api.binance.com/api/v3/ticker/price?symbol=" . $coin ."USDT";
		$json_data = file_get_contents("$url");
		$json_array = json_decode($json_data, true);
		$curr_price = $json_array["price"] / $ex_rate;
	}

	return $curr_price;
}

$coin = "BTC";
$coin_price = @current_price($coin);

?>
