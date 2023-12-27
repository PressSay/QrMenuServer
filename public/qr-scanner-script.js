function initScanner(notInitScanner) {
    // alert(notInitScanner);
    if (notInitScanner == 0) {
        return;
    }
    // alert("Please scan QR code to order");
    let video = document.getElementById('qr-video');
    
    // window.alert("Please scan QR code to order");
    let toggleStartScan = false;
    let firstScan = true;

    const qrResult = document.getElementById('file-qr-result');

    function setResult(label, result) {
        console.log(result.data);
        label.value = result.data;
        label.style.color = 'teal';
    }

    // ####### Web Cam Scanning #######

    const scanner = new QrScanner(video, result => setResult(qrResult, result), {
        onDecodeError: error => {
            qrResult.textContent = error;
            qrResult.style.color = 'inherit';
        },
        highlightScanRegion: true,
        highlightCodeOutline: true,
    });

    // for debugging
    window.scanner = scanner;

    document.getElementById('start-button').addEventListener('click', () => {
        if (!toggleStartScan && firstScan) {
            scanner.start().then(() => {
                // List cameras after the scanner started to avoid listCamera's stream and the scanner's stream being requested
                // at the same time which can result in listCamera's unconstrained stream also being offered to the scanner.
                // Note that we can also start the scanner after listCameras, we just have it this way around in the demo to
                // start the scanner earlier.
            });
            toggleStartScan = true;
            firstScan = false;
        } else if (toggleStartScan && !firstScan) {
            scanner.stop();
            toggleStartScan = false;
        } else if (!toggleStartScan && !firstScan) {
            scanner.start();
            toggleStartScan = true;
        }
    });

    // ####### File Scanning #######

    document.getElementById('file-selector').addEventListener('change', event => {
        const file = document.getElementById('file-selector').files[0];
        if (!file) {
            return;
        }
        QrScanner.scanImage(file, {
            returnDetailedScanResult: true
        })
            .then(result => setResult(qrResult, result))
            .catch(e => setResult(qrResult, {
                data: e || 'No QR code found.'
            }));
    });
}

