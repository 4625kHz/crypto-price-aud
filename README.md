# historical-crypto-price-aud
PHP script that returns the historial price of a crypto coin/token in AUD via the binance.com API.

If the chosen coin/token is not traded against AUD on Binance, the script calculates the price indirectly by dividing the historial coin/token price in USDT by the historical AUD/USDT trading price.

Script reads Date/Time in the format 2022-06-04 15:05

Time interval used is 1 minute, closing price for chosen historical minute is returned.

Alternative time intervals, eg. 1 hour (1h) or 1 day (1d) can be used in API URLs.

If 1 hour intervals are used, minutes in Date/Time must be 00.

If 1 day intervals are used, hours and minutes in Date/Time must be 00:00.
