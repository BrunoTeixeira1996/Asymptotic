<?php
$artista = (isset($_GET['artista'])) ? $_GET['artista'] : "ABBA";
$pagina = (isset($_GET['page']) && $_GET['page'] >= 1) ? $_GET['page'] : 1;
 
 
$curl = curl_init();
curl_setopt_array($curl, array(
    CURLOPT_RETURNTRANSFER => 1,
    CURLOPT_URL => 'https://api.discogs.com/database/search?&token=TOKEN&page=' . urlencode($pagina) . '&per_page=12&artist=' . urlencode($artista) . '',
    CURLOPT_USERAGENT => 'r00t'
));
$response = curl_exec($curl);
$json = json_decode($response, true);

?>
<html>
<head>
<title>Asymptotic</title>
</head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="shortcut icon" type="image/png" href="favicon.png">
<body>

<header>

    <div class="collapse bg-dark" id="navbarHeader">
        <div class="container">
        
            <div class="row">
                <div class="col-sm-8 col-md-7 py-4">
                    <h4 class="text-white">About Asymptotic</h4>
                    <p class="text-muted">Asymptotic is a WebApp that is used to search all the discography that a music artist did.
                    It uses a very simple and amazing API from <a href="https://www.discogs.com/developers">Discogs</a>, a little bit 
                    of PHP and Bootstrap. Remember that Discogs allow contributors to put their albums on their website(For example:  for sale
                    and/or exchange) so it's normal that some covers/names are not in English.</p>
                </div>
                <div class="col-sm-4 offset-md-1 py-2">
                <div class="col-sm-5 offset-md-1 py-4">
                    <h4 class="text-white">Contact</h4>
                    <ul class="list-unstyled">
                        <a style="font-size:25px;" href="https://www.facebook.com/brunoteixeiraze" class="fa fa-facebook"></a>
                        <a style="font-size:25px;" href="https://twitter.com/BrunoTeixeira49" class="fa fa-twitter"></a>
                        <a style="font-size:25px;" href="https://www.linkedin.com/in/bruno-teixeira-1553b4a1/" class="fa fa-linkedin"></a>
                        <a style="font-size:25px;" href="https://github.com/BrunoTeixeira1996" class="fa fa-github"></a>
                </div>
                </div>
            </div>
        </div>
    </div>
    <div class="navbar navbar-dark bg-dark box-shadow">
        <div class="container d-flex justify-content-between">
            <a href="index.php" class="navbar-brand d-flex align-items-center"></a>
            <div class="container">
                <div class="pull-right">
                <form action="index.php" method="GET" id="formu" class="form-inline md-form mr-auto mb-4">
                    <input name="artista" placeholder="Search" required class="form-control mr-sm-1" aria-label="Search">
                    <button form="formu" class="btn btn-outline-primary" type="submit">Search</button>
                </form>
                </div>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </div>
</header>
 
<main role="main">
    <div class="album py-5 bg-light">
        <div class="container">
            <div class="row">
                <?php foreach ($json['results'] as $value):
                    $title = $value['title'];
                    $genre = $value['genre'][0];
                    $country = $value['country'];
                    $format = $value['format'][0];
                    $edition = $value['format'][2] ?? 'No edition found';
                    $year = array_key_exists('year', $value) ? $value['year'] : 'No year found';
                    $img = array_key_exists('cover_image', $value) ? $value['cover_image'] : '';?>
                <div class="col-md-3">
                    <div class="card mb-4 box-shadow">
                        <img class="card-img-top" src="<?php echo $img; ?>" alt="image">
                        <div class="card-body">
                            <p class="card-text"> <?php echo $title; ?> </p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-sm btn-outline-secondary"><?php echo $value['genre'][0]; ?></button>
                                    <button type="button" class="btn btn-sm btn-outline-secondary"><?php echo $year?></button>
                                    <button type="button" class="btn btn-sm btn-outline-secondary"><?php echo $format?></button>
                                    <button type="button" class="btn btn-sm btn-outline-secondary"><?php echo $edition?></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
                <?php endforeach; ?>
            </div>
        </div> 
        <div class="col-md-12 text-center">
            <a href="index.php?page=<?=urlencode($pagina-1)?>&artista=<?=$artista?>" class="btn btn-primary btn-lg">Previous Page</a>
            <a href="index.php?page=<?=urlencode($pagina+1)?>&artista=<?=$artista?>" class="btn btn-primary btn-lg ">Next Page</a>
        </div>
    </div>
 
</main>


<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
</body>

</html>
