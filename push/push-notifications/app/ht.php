<!doctype html>
<html>

<head>
    <meta charset=utf-8>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="A front-end template that helps you build fast, modern mobile web apps.">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Simple Push Demo</title>
    <link rel="manifest" href="manifest.json">
    <link rel="stylesheet" href="https://storage.googleapis.com/code.getmdl.io/1.0.6/material.indigo-pink.min.css">
    <script src="https://storage.googleapis.com/code.getmdl.io/1.0.6/material.min.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://simple-push-demo.appspot.com/styles/main.css">
</head>

<body>
    <div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">       
        <main>
            <div class="push-switch-container js-push-switch-container"><label class="mdl-switch mdl-js-switch mdl-js-ripple-effect js-push-toggle-switch" for="switch-2"><input type="checkbox" id="switch-2" class="mdl-switch__input" disabled> <span class="mdl-switch__label">Enable Push Notifications</span></label></div>
            <div class="content-overlap-wrapper">
                <div class="send-push-options js-send-push-options">
                    <p class="center"><button class="xhr-button js-send-push-button mdl-button mdl-js-button mdl-button--raised mdl-button--colored mdl-js-ripple-effect">Send a Push to GCM via XHR</button></p>
                    <p class="center">OR</p>
                    <p>Copy and paste the following CURL command into your terminal to send a push message to your browser.</p><code class="curl-code-example js-curl-code"></code></div>
                <div class="error-message-container js-error-message-container">
                    <h1 class="error-title js-error-title"></h1>
                    <p class="error-message js-error-message"></p>
                </div>
            </div>           
        </main>
    </div>
    <script src="js/main.js"></script>
</body>

</html>