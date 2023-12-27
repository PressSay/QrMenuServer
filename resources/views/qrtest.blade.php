<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>QR Scanner Demo</title>
    @vite(['resources/js/app.js'])
</head>
<body>
<h1>Scan from WebCam:</h1>
<div id="video-container">
    <video id="qr-video"></video>
</div>
<div class="Hello">
    <label>
        Highlight Style
        <select id="scan-region-highlight-style-select">
            <option value="default-style">Default style</option>
            <option value="example-style-1">Example custom style 1</option>
            <option value="example-style-2">Example custom style 2</option>
        </select>
    </label>
    <label>
        <input id="show-scan-region" type="checkbox">
        Show scan region canvas
    </label>
</div>
<div>
    <select id="inversion-mode-select">
        <option value="original">Scan original (dark QR code on bright background)</option>
        <option value="invert">Scan with inverted colors (bright QR code on dark background)</option>
        <option value="both">Scan both</option>
    </select>
    <br>
</div>
<b>Device has camera: </b>
<span id="cam-has-camera"></span>
<br>
<div>
    <b>Preferred camera:</b>
    <select id="cam-list">
        <option value="environment" selected>Environment Facing (default)</option>
        <option value="user">User Facing</option>
    </select>
</div>
<b>Camera has flash: </b>
<span id="cam-has-flash"></span>
<div>
    <button id="flash-toggle">📸 Flash: <span id="flash-state">off</span></button>
</div>
<br>
<b>Detected QR code: </b>
<span id="cam-qr-result">None</span>
<br>
<b>Last detected at: </b>
<span id="cam-qr-result-timestamp"></span>
<br>
<button id="start-button">Start</button>
<button id="stop-button">Stop</button>
<hr>

<h1>Scan from File:</h1>
<input type="file" id="file-selector">
<b>Detected QR code: </b>
<span id="file-qr-result">None</span>

<!--<script src="../qr-scanner.umd.min.js"></script>-->
<!--<script src="../qr-scanner.legacy.min.js"></script>-->

<style>
    div {
        margin-bottom: 16px;
    }

    #video-container {
        line-height: 0;
    }

    #video-container.example-style-1 .scan-region-highlight-svg,
    #video-container.example-style-1 .code-outline-highlight {
        stroke: #64a2f3 !important;
    }

    #video-container.example-style-2 {
        position: relative;
        width: max-content;
        height: max-content;
        overflow: hidden;
    }
    #video-container.example-style-2 .scan-region-highlight {
        border-radius: 30px;
        outline: rgba(0, 0, 0, .25) solid 50vmax;
    }
    #video-container.example-style-2 .scan-region-highlight-svg {
        display: none;
    }
    #video-container.example-style-2 .code-outline-highlight {
        stroke: rgba(255, 255, 255, .5) !important;
        stroke-width: 15 !important;
        stroke-dasharray: none !important;
    }

    #flash-toggle {
        display: none;
    }

    hr {
        margin-top: 32px;
    }
    input[type="file"] {
        display: block;
        margin-bottom: 16px;
    }
</style>
</body>
</html>