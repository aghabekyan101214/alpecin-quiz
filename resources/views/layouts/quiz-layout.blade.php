<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alpecin Quiz</title>
    <!-- FontAwesome-cdn include -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <!-- Google fonts include -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@800&family=Sen:wght@400;700;800&display=swap"
          rel="stylesheet">
    <!-- Bootstrap-css include -->
    <link rel="stylesheet" href="{{ asset("quiz-assets/css/bootstrap.min.css") }}">
    <!-- Animate-css include -->
    <link rel="stylesheet" href="{{ asset("quiz-assets/css/animate.min.css") }}">
    <!-- Main-StyleSheet include -->
    <link rel="stylesheet" href="{{ asset("quiz-assets/css/style.css?version=1.2") }}">
</head>

<body>
@yield("container")
<!-- jQuery-js include -->
<script src="{{ asset("quiz-assets/js/jquery-3.6.0.min.js") }}"></script>
<!-- Countdown-js include -->
<script src="{{ asset("quiz-assets/js/countdown.js") }}"></script>
<!-- Bootstrap-js include -->
<script src="{{ asset("quiz-assets/js/bootstrap.min.js") }}"></script>
<!-- jQuery-validate-js include -->
<script src="{{ asset("quiz-assets/js/jquery.validate.min.js") }}"></script>
<!-- Custom-js include -->
<script src="{{ asset("quiz-assets/js/script.js") }}"></script>
</body>
</html>
