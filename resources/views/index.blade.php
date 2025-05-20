<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Tubes PAB Dea</title>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center">
    <div class="w-full max-w-md bg-white p-8 rounded shadow">
        <h1 class="text-2xl font-bold mb-6 text-center">Test API</h1>

        <form id="loginForm" class="space-y-4">
            <div>
                <label for="nim" class="block font-medium">NIM</label>
                <input type="text" id="nim" name="nim"
                    class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500" />
            </div>
            <div>
                <label for="password" class="block font-medium">Password</label>
                <input type="password" id="password" name="password"
                    class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500" />
            </div>
            <button type="submit"
                class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700 transition duration-200">Login</button>
        </form>

        <div id="buttons" class="mt-6 hidden space-y-2">
            <button onclick="getUser()" class="w-full bg-green-600 text-white py-2 rounded hover:bg-green-700">Get
                User</button>
            <button onclick="getDashboard()"
                class="w-full bg-indigo-600 text-white py-2 rounded hover:bg-indigo-700">Get Admin Dashboard</button>
            <button onclick="logout()"
                class="w-full bg-red-600 text-white py-2 rounded hover:bg-red-700">Logout</button>
        </div>

        <div id="response"
            class="mt-6 p-4 bg-gray-100 border border-gray-300 rounded text-sm whitespace-pre-wrap overflow-auto max-h-60">
        </div>
    </div>

    <script>
        let token = '';

        document.getElementById('loginForm').addEventListener('submit', async function (e) {
            e.preventDefault();

            const nim = document.getElementById('nim').value;
            const password = document.getElementById('password').value;

            const response = await fetch('/api/login', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                },
                body: JSON.stringify({ nim, password })
            });

            const result = await response.json();
            console.log("Login response:", result); // Debug

            // Cek apakah token ada
            if (result.token || result.access_token) {
                token = result.token || result.access_token;
                document.getElementById('buttons').classList.remove('hidden');
            } else {
                alert("Login gagal. Token tidak ditemukan.");
            }

            document.getElementById('response').innerText = JSON.stringify(result, null, 4);
        });

        async function getUser() {
            const res = await fetch('/api/admin/users', {
                method: 'GET',
                headers: {
                    'Authorization': 'Bearer ' + token,
                    'Accept': 'application/json',
                }
            });

            const data = await res.json();
            document.getElementById('response').innerText = JSON.stringify(data, null, 4);
        }

        async function getDashboard() {
            const res = await fetch('/api/admin/dashboard', {
                method: 'GET',
                headers: {
                    'Authorization': 'Bearer ' + token,
                    'Accept': 'application/json',
                }
            });

            const data = await res.json();
            document.getElementById('response').innerText = JSON.stringify(data, null, 4);
        }

        async function logout() {
            const res = await fetch('/api/logout', {
                method: 'POST',
                headers: {
                    'Authorization': 'Bearer ' + token,
                    'Accept': 'application/json',
                }
            });

            const data = await res.json();
            document.getElementById('response').innerText = JSON.stringify(data, null, 4);
            token = '';
            document.getElementById('buttons').classList.add('hidden');
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
</body>

</html>