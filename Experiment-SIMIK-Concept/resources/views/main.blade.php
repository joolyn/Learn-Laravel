<!DOCTYPE html>
<html>
<body style="font-family:sans-serif;">
    <h1>Status: <span id="mode">{{ $mode }}</span></h1>
    <form method="POST" action="/toggle-mode">
        @csrf
        <button type="submit" style="font-size:24px;">Tekan Untuk Manual / Autopilot</button>
    </form>
    <br>
    <h1>Status: <span id="status">{{ $status }}</span></h1>
    <form method="POST" action="/toggle-status">
        @csrf
        <button type="submit" style="font-size:24px;">Tekan Untuk Nyala / Mati</button>
    </form>

</body>
</html>
