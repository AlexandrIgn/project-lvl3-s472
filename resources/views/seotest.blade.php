@extends('layouts.navbar')

@section('title', 'Page analyzer')

@section('content')
    <div class="jumbotron jumbotron-fluid">
      <div class="container">
        <h1 class="display-4">Page analyzer</h1>
        <?php if (isset($error)): ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong><?= $error ?></strong> 
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif ?>
        <form class="form-inline" action="{{ route('domains.store')  }}" method="post">
            <input class="form-control mr-sm-2" name="url" type="search" placeholder="Enter URL" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Analyze</button>
        </form>
         <p class="lead">Enter url for seo test.</p> 
      </div>
    </div>
@endsection
