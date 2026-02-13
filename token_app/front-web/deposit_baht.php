<?php 
	$customer_email = "omiezenfone@gmail.com";
	$product_detail = "product-0004";
	$refnum = "000000000004";
	/*
	$url = "https://api.exchangerate-api.com/v4/latest/USD";
	// Fetch the JSON response
	$response = file_get_contents($url);
	$data = json_decode($response, true);
	// Get the rate from the data array
	$rate = $data['rates']['THB'];

	$ex_rate = (float)$rate; */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deposit - Omega Coin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Inter', sans-serif; }</style>
</head>
<body class="bg-gray-100 min-h-screen flex justify-center items-center p-4">
	<form>
		<div class="w-full max-w-md bg-white min-h-[700px] shadow-2xl rounded-[3rem] overflow-hidden flex flex-col border-8 border-gray-900">
			
			<div class="p-6 flex items-center gap-4">
				<button class="w-10 h-10 flex items-center justify-center bg-gray-50 rounded-full text-gray-600 hover:bg-gray-200">
					<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
					</svg>
				</button>
				<h1 class="text-xl font-bold text-gray-800">Add Coin</h1>
			</div>

			<div class="px-6 py-8 text-center">
				<p class="text-gray-500 text-sm mb-2">Enter Amount</p>
				<div class="flex justify-center items-baseline gap-1">
					<span class="text-3xl font-bold text-indigo-600">THB</span>		
					<input id="thb-input" type="number" placeholder="0.00" class="text-5xl font-bold text-gray-800 w-full text-center outline-none bg-transparent" autofocus>
				</div>
				<!-- <div>
					<span class="text-xl font-bold text-indigo-600">≈ <span id="thb-output">0.00</span> THB**</span>
				</div> -->
			</div>

			<div class="flex justify-center gap-3 px-6 mb-8">
				<button id="btnAdd10" class="px-4 py-2 border border-gray-200 rounded-full text-sm font-medium hover:bg-indigo-50 hover:border-indigo-200 transition-colors">+฿10</button>
				<button id="btnAdd50" class="px-4 py-2 border border-gray-200 rounded-full text-sm font-medium hover:bg-indigo-50 hover:border-indigo-200 transition-colors">+฿50</button>
				<button id="btnAdd100" class="px-4 py-2 border border-gray-200 rounded-full text-sm font-medium hover:bg-indigo-50 hover:border-indigo-200 transition-colors">+฿100</button>
			</div>

			<div class="px-6 flex-grow">
				<h3 class="text-sm font-bold text-gray-400 uppercase tracking-wider mb-4">Select Source</h3>
				
				<div class="flex items-center justify-between p-4 border-2 border-indigo-500 bg-indigo-50 rounded-2xl mb-3 cursor-pointer">
					<div class="flex items-center gap-4">
						<div class="w-10 h-10 bg-white rounded-lg flex items-center justify-center shadow-sm text-xl">💵</div>
						<div>
							<p class="font-bold text-gray-800">Pay Solution Asia</p>
							<!-- <p class="text-xs text-indigo-600">Balance: $4,200.00</p> -->
						</div>
					</div>
					<div class="w-6 h-6 bg-indigo-600 rounded-full flex items-center justify-center">
						<svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
						</svg>
					</div>
				</div>
				
				<div class="flex items-center justify-between p-4 border border-gray-100 rounded-2xl hover:bg-gray-50 cursor-pointer transition-colors">
					<!--
					<div class="flex items-center gap-4">
						<div class="w-10 h-10 bg-white rounded-lg flex items-center justify-center shadow-sm text-xl">💳</div>
						<div>
							<p class="font-bold text-gray-800">Mastercard</p>
							<p class="text-xs text-gray-500">**** 4421</p>
						</div>
					</div>
					<div class="w-6 h-6 border-2 border-gray-200 rounded-full"></div>
					-->
				</div> 
			</div>
			<div class="p-6">
				<!--
				<span class="w-6 h-6 text-sm font-bold text-gray-300">
				** The above rate is an estimate. The actual rate will be provided by the payment gateway service provider at the time of purchase.
				</span>
				-->
			</div>
			<div class="p-6">
				<button class="w-full bg-indigo-600 py-4 rounded-2xl text-white font-bold text-lg shadow-lg shadow-indigo-200 active:scale-95 transition-transform">
					Confirm Deposit
				</button>
			</div>
		</div>
		
		<input type="hidden" name="merchantid" value="68347300">
        <input type="hidden" name="cc" value="00">
        <input type="hidden" id="value_total" name="total" value="1">        
        <input type="hidden" name="lang" value="EN">
	</form>
	<script>		
		
		const thbInput = document.getElementById('thb-input');
		const value_total = document.getElementById('value_total');
		
		const add10 = document.getElementById('btnAdd10');
		const add50 = document.getElementById('btnAdd50');
		const add100 = document.getElementById('btnAdd100');
		
		
		thbInput.onchange = function(e) {
			const thb = parseFloat(e.target.value) || 0;
			
			// Update the global variable
			//thb_value = usd * RATE;
			
			// Update the UI
			thbInput.value = thb.toLocaleString("en-GB", {
				minimumFractionDigits: 2 
			});
			value_total.value = thb;
			
			console.log("Value finalized:", thbInput.innerText);
		};
		
		function addMoney(amount) {
			var thbInput = document.getElementById('thb-input');
			myValue = parseFloat(thbInput.value);
			
			if (isNaN(myValue)) {
				myValue = 0.0;
			}
			
			myValue += amount;
			thbInput.value = myValue.toLocaleString("en-GB", {
				minimumFractionDigits: 2 
			});	

			value_total.value = myValue;			
		}
		
		add10.onclick = function() {					
			addMoney(10.00);
		}
		
		add50.onclick = function() {					
			addMoney(50.00);
		}
		
		add100.onclick = function() {					
			addMoney(100.00);
		}
		
		/*
		// Update whenever the user types
		usdInput.addEventListener('input', updateConversion);

		// Optional: Make the Quick Amount chips work too
		document.querySelectorAll('.quick-chip').forEach(chip => {
			chip.addEventListener('click', () => {
				const val = chip.getAttribute('data-value');
				usdInput.value = val;
				updateConversion();
			});
		}); */
	</script>

</body>
</html>