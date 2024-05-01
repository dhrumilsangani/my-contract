<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>{{ config('app.name', 'Contract') }}</title>
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('front/images/favicon.svg') }}" />

    <style>
	body, html {
	  height: 100%;
	  margin: 0;
	}

	.bgimg {
	  background-image: url('{{ asset('front/images/forestbridge.jpg') }}');
	  height: 100%;
	  background-position: center;
	  background-size: cover;
	  position: relative;
	  color: white;
	  font-family: "Courier New", Courier, monospace;
	  font-size: 25px;
	}

	.topleft {
	  position: absolute;
	  top: 0;
	  left: 16px;
	}
	
	.topleft .logo{
		width:20%;
	}

	.bottomleft {
	  position: absolute;
	  bottom: 0;
	  left: 16px;
	}

	.middle {
	  position: absolute;
	  top: 50%;
	  left: 50%;
	  transform: translate(-50%, -50%);
	  text-align: center;
	}

	hr {
	  margin: auto;
	  width: 40%;
	}
	</style>
</head>