<!doctype html>
<html lang="lv">
	<head>
		<meta charset="utf-8">
		<title>PD 2 - {{ $title }}</title>
		<meta name="description" content="">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-
beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-
eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
		
	</head>
	<body>
		<script src="/js/main.js"></script>
		<div class="bg-light mb-4 py-4">
			<div class="container">
				<div class="row">
					<header class="col-md-12">
						<nav class="navbar navbar-light navbar-expand-md">
							<span class="navbar-brand mb-0 h1">kristaps.ridus</span>
							<button class="navbar-toggler" type="button" data-bstoggle="collapse" data-bs-target="#navbarNav">
								<span class="navbar-toggler-icon"></span>
							</button>
							<div class="collapse navbar-collapse" id="navbarNav">
								<ul class="navbar-nav">
									@if(Auth::check())
										<li class="nav-item">
											<a class="nav-link" href="/">Sākumlapa</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" href="/authors">Autori</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" href="/albums">Albumi</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" href="/zanri">Žanri</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" href="/logout">Beigt darbu</a>
										</li>
									@else
										<li class="nav-item">
											<a class="nav-link" href="/login">Pieslēgties</a>
										</li>
									@endif
								</ul>
							</div>
						</nav>
					</header>
				</div>
			</div>
		</div>
	</body>
</html>