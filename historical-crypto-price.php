<?php 

function historical_price($coin, $date_time) {
	date_default_timezone_set('Australia/Sydney');
	$timestamp = strtotime($date_time) * 1000;
	$url = "https://api.binance.com/api/v1/klines?symbol=" . $coin . "AUD&interval=1m&startTime=" . $timestamp . "&endTime=" . $timestamp;

	// Coin/AUD pair traded on Binance exchange
	if ($json_data = file_get_contents("$url")) {
		$json_array = json_decode($json_data, true);
		$hist_price = $json_array[0][4];
	}

	// Coin/AUD pair not traded on Binance exchange
	else {
		$url = "https://api.binance.com/api/v1/klines?symbol=AUDUSDT&interval=1m&startTime=" . $timestamp . "&endTime=" . $timestamp;
		$json_data = file_get_contents("$url");
		$json_array = json_decode($json_data, true);
		$ex_rate = $json_array[0][4];

		$url = "https://api.binance.com/api/v1/klines?symbol=" . $coin . "USDT&interval=1m&startTime=" . $timestamp . "&endTime=" . $timestamp;
		$json_data = file_get_contents("$url");
		$json_array = json_decode($json_data, true);
		$hist_price = $json_array[0][4] / $ex_rate;
	}

	return $hist_price;
}

$date_time = "2022-06-04 15:05";
$coin = "BTC";
$hist_coin_price = @historical_price($Coin, $date_time);

?>
