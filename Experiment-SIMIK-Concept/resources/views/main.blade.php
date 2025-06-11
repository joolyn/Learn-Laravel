<!DOCTYPE html>
<head>
    <title>Main Web</title>
    @vite(['resources/js/app.js'])
</head>
<html>
<body style="font-family:sans-serif;">
    {{-- <h1>Status: <span id="mode">{{ $mode }}</span></h1>
    <form method="POST" action="/toggle-mode">
        @csrf
        <button id="myButton" type="submit" style="font-size:24px;">Tekan Untuk Manual / Autopilot</button>
    </form>
    <br>
    <h1>Status: <span id="status">{{ $status }}</span></h1>
    <form method="POST" action="/toggle-status">
        @csrf
        <button type="submit" style="font-size:24px;">Tekan Untuk Nyala / Mati</button>
    </form> --}}

    <h1>Status: <span id="mode"></span></h1>
    <button id="myButton" onclick="sendMode()" type="submit" style="font-size:24px;">Tekan Untuk Manual / Autopilot</button>
    <br>
    <h1>Status: <span id="status"></span></h1>
    <button type="submit" onclick="sendStatus" style="font-size:24px;">Tekan Untuk Nyala / Mati</button>

    <script></script>
    <script>
        // Shortcut A
        document.addEventListener("keypress", function(event) {
            if (event.key === "a" || event.key === "A") {
                event.preventDefault();
                document.getElementById('myButton').click();
            }
        });
        
        // Get Data
        function getData() {
            axios.get('http://103.179.56.23:8000/iot')
                .then(response => {
                    const data = response.data;

                    // Perbaikan penulisan function dan ID
                    document.getElementById('mode').textContent = data.mode || "";
                    document.getElementById('status').textContent = data.status || "";
                })
                .catch(error => {
                    console.error('Error ambil data:', error);
                });
        }

        // Panggil setiap 500ms
        setInterval(getData, 500);
        getData();

        function sendMode() {
            const modeElement = document.getElementById('mode');
            const modeValue = modeElement.textContent; // atau gunakan .value jika <input>

            axios.post('http://103.179.56.23:8000/sendmode', {
                mode: modeValue
            })
            .then(function (response) {
                console.log('Response:', response.data);
            })
            .catch(function (error) {
                console.error('Terjadi kesalahan:', error);
            });
        }


        
    </script>
</body>
</html>

