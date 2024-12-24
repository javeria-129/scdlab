self.onmessage = function (e) {
    const eventDetails = e.data;

    // Simulate saving data
    setTimeout(() => {
        self.postMessage({ status: 'success', message: 'Event saved successfully!' });
    }, 2000);
};
