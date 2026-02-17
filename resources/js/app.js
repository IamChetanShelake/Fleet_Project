import './bootstrap';
console.log('Echo config:', window.Echo.connector.options);

Echo.channel('test-channel')
    .listen('TestBroadcast', (e) => {
        console.log(e.message);
    });