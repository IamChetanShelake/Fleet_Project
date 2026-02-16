<!DOCTYPE html>
<html>

<head>
    <title>WebSocket Test</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
    <h1>Laravel Reverb Test</h1>

    <div id="messages"></div>

    <button onclick="sendTest()">Send Test Event</button>

    <script src="{{ asset('js/app.js') }}" defer></script>

    <script>
        // Listen for messages
        window.Echo.channel('test-channel')
            .listen('.test.event', (e) => {
                console.log('Received:', e);
                document.getElementById('messages').innerHTML +=
                    `<p>${e.message} at ${new Date().toLocaleTimeString()}</p>`;
            });

        function sendTest() {
            fetch('/test-broadcast')
                .then(response => response.text())
                .then(data => console.log(data));
        }

        console.log('Echo initialized:', window.Echo);
    </script>
</body>

</html>
