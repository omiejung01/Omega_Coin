<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Omega Coin - Web Front</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Inter', sans-serif; }</style>
</head>
<body class="bg-gray-100 min-h-screen flex justify-center items-center">

    <div class="w-full max-w-md bg-white min-h-[800px] shadow-2xl rounded-[3rem] overflow-hidden relative border-8 border-gray-900">
        
        <div class="p-6 flex justify-between items-center">
            <div>
                <p class="text-gray-500 text-sm">Welcome back,</p>
                <h1 class="text-xl font-bold text-gray-800">Alex Rivera</h1>
            </div>
            <div class="w-12 h-12 bg-indigo-100 rounded-full flex items-center justify-center">
                <span class="text-indigo-600 font-bold">AR</span>
            </div>
        </div>

        <div class="mx-6 p-6 bg-gradient-to-br from-indigo-600 to-purple-700 rounded-3xl text-white shadow-lg shadow-indigo-200">
            <p class="opacity-80 text-sm mb-1">Total Balance</p>
            <h2 class="text-3xl font-bold mb-6">$12,450.80</h2>
            <div class="flex justify-between items-end">
                <p class="tracking-widest">**** **** **** 8842</p>
                <p class="font-semibold italic text-xl">VISA</p>
            </div>
        </div>

        <div class="grid grid-cols-4 gap-4 p-6">
            <div class="flex flex-col items-center gap-2">
				<a href="deposit.php">
                <div class="w-14 h-14 bg-blue-50 rounded-2xl flex items-center justify-center text-blue-600 hover:bg-blue-600 hover:text-white transition-all cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
				</div>
				</a>
                <span class="text-xs font-medium text-gray-600">Deposit</span>
            </div>
            <div class="flex flex-col items-center gap-2">
                <div class="w-14 h-14 bg-green-50 rounded-2xl flex items-center justify-center text-green-600 hover:bg-green-600 hover:text-white transition-all cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
                    </svg>
                </div>
                <span class="text-xs font-medium text-gray-600">Send</span>
            </div>
            <div class="flex flex-col items-center gap-2">
                <div class="w-14 h-14 bg-purple-50 rounded-2xl flex items-center justify-center text-purple-600 hover:bg-purple-600 hover:text-white transition-all cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                </div>
                <span class="text-xs font-medium text-gray-600">Bills</span>
            </div>
            <div class="flex flex-col items-center gap-2">
                <div class="w-14 h-14 bg-orange-50 rounded-2xl flex items-center justify-center text-orange-600 hover:bg-orange-600 hover:text-white transition-all cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                    </svg>
                </div>
                <span class="text-xs font-medium text-gray-600">Stats</span>
            </div>
        </div>

        <div class="px-6 pb-20">
            <div class="flex justify-between items-center mb-4">
                <h3 class="font-bold text-gray-800">Recent Transactions</h3>
                <button class="text-indigo-600 text-sm font-semibold">See All</button>
            </div>

            <div class="space-y-4">
                <div class="flex items-center justify-between p-2">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-gray-100 rounded-xl flex items-center justify-center text-xl">☕</div>
                        <div>
                            <p class="font-bold text-gray-800">Starbucks</p>
                            <p class="text-xs text-gray-500">Today, 09:41 AM</p>
                        </div>
                    </div>
                    <p class="font-bold text-red-500">-$5.50</p>
                </div>

                <div class="flex items-center justify-between p-2">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-gray-100 rounded-xl flex items-center justify-center text-xl">🛍️</div>
                        <div>
                            <p class="font-bold text-gray-800">Amazon Purchase</p>
                            <p class="text-xs text-gray-500">Yesterday, 04:20 PM</p>
                        </div>
                    </div>
                    <p class="font-bold text-red-500">-$42.00</p>
                </div>

                <div class="flex items-center justify-between p-2">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-gray-100 rounded-xl flex items-center justify-center text-xl">💰</div>
                        <div>
                            <p class="font-bold text-gray-800">Salary Deposit</p>
                            <p class="text-xs text-gray-500">Feb 10, 2026</p>
                        </div>
                    </div>
                    <p class="font-bold text-green-500">+$3,200.00</p>
                </div>
            </div>
        </div>

        <div class="absolute bottom-0 w-full bg-white border-t flex justify-around p-4">
            <button class="text-indigo-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24"><path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/></svg>
            </button>
            <button class="text-gray-400">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a2 2 0 002-2V7a2 2 0 00-2-2H6a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
            </button>
            <button class="text-gray-400">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
            </button>
        </div>
    </div>

</body>
</html>