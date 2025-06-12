<!DOCTYPE html>
<head>
    <title>Main Web</title>
    @vite(['resources/js/app.js'])
</head>
<html>
<body style="font-family:sans-serif;">
    <!-- {{-- <h1>Status: <span id="mode">{{ $mode }}</span></h1> -->
    <!-- <form method="POST" action="/toggle-mode">
        @csrf
        <button id="myButton" type="submit" style="font-size:24px;">Tekan Untuk Manual / Autopilot</button>
    </form>
    <br>
    <h1>Status: <span id="status">{{ $status }}</span></h1>
    <form method="POST" action="/toggle-status">
        @csrf
        <button type="submit" style="font-size:24px;">Tekan Untuk Nyala / Mati</button>
    </form> --}} -->

    <h1>Status: <span id="mode"></span></h1>
    <button id="myButton" onclick="sendMode()" type="submit" style="font-size:24px;">Tekan Untuk Manual / Autopilot</button>
    <br>
    <h1>Do it: <span id="do"></span></h1>
    <button id="myButtonForward" onclick="doForward()" type="submit" style="font-size:24px;">Forward</button>
    <button id="myButtonLeft" onclick="doLeft()" type="submit" style="font-size:24px;">Left</button>
    <button id="myButtonRight" onclick="doRight()" type="submit" style="font-size:24px;">Right</button>
    <button id="myButtonStop" onclick="doStop()" type="submit" style="font-size:24px;">Stop</button>
    <button id="myButtonBackward" onclick="doBackward()" type="submit" style="font-size:24px;">Backward</button>
    <br>
    <h1>Status: <span id="status"></span></h1>
    <button type="submit" onclick="sendStatus" style="font-size:24px;">Tekan Untuk Nyala / Mati</button>

    <script></script>
    <script>
        // window.onload = getData();

        document.addEventListener('DOMContentLoaded', () => {
            getData();
        });

        // Shortcut 
        document.addEventListener("keypress", function(event) {
            if (event.key === "w" || event.key === "W") {
                event.preventDefault();
                document.getElementById('myButtonForward').click();
            } else if (event.key === "a" || event.key === "A") {
                event.preventDefault();
                document.getElementById('myButtonLeft').click();
            } else if (event.key === "s" || event.key === "S") {
                event.preventDefault();
                document.getElementById('myButtonStop').click();
            } else if (event.key === "d" || event.key === "D") {
                event.preventDefault();
                document.getElementById('myButtonRight').click();
            }
        });
        

        // Get Data
        function getData() {
            axios.get('http://localhost:8000/iot')
                .then(response => {
                    const data = response.data;

                    // Perbaikan penulisan function dan ID
                    document.getElementById('mode').textContent = data.mode || "";
                    document.getElementById('do').textContent = data.action || "";
                })
                .catch(error => {
                    console.error('Error ambil data:', error);
                });
        }

        function sendMode() {
            const modeElement = document.getElementById('mode');
            const modeValue = modeElement.textContent; // atau gunakan .value jika <input>

            axios.post('http://localhost:8000/sendmode', {
                mode: modeValue
            })
            .then(function (response) {
                console.log('Response:', response.data);
                getData();
    
            })
            .catch(function (error) {
                console.error('Terjadi kesalahan:', error);
            });
        }
        
        function doForward () {
            axios.post('http://localhost:8000/send-do', {
                "do": "forward"
            })
            .then(function (response) {
                console.log('Response:', response.data);
                getData();
    
            })
            .catch(function (error) {
                console.error('Terjadi kesalahan:', error);
            });
        }

        function doLeft () {
            axios.post('http://localhost:8000/send-do', {
                "do": "left"
            })
            .then(function (response) {
                console.log('Response:', response.data);
                getData();
            })
            .catch(function (error) {
                console.error('Terjadi kesalahan:', error);
            });
        }

        function doRight () {
            axios.post('http://localhost:8000/send-do', {
                "do": "right"
            })
            .then(function (response) {
                console.log('Response:', response.data);
                getData();
            })
            .catch(function (error) {
                console.error('Terjadi kesalahan:', error);
            });
        }

        function doStop () {
            axios.post('http://localhost:8000/send-do', {
                "do": "stop"
            })
            .then(function (response) {
                console.log('Response:', response.data);
                getData();
            })
            .catch(function (error) {
                console.error('Terjadi kesalahan:', error);
            });
        }

        function doBackward () {
            axios.post('http://localhost:8000/send-do', {
                "do": "backward"
            })
            .then(function (response) {
                console.log('Response:', response.data);
                getData();
            })
            .catch(function (error) {
                console.error('Terjadi kesalahan:', error);
            });
        }
    </script>
</body>
</html>

