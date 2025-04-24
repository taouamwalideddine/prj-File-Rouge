import './bootstrap';
    
Echo.channel('test-channel')
    .listen('.test-event', (e) => {
        console.log('Received:', e.message);
    });
