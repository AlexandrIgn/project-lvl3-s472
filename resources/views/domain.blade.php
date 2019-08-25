@extends('layouts.navbar')

@section('title', 'Domain')

@section('content')
    <table class="table">
    <thead class="thead-light">
        <tr>
            <th scope="col">id</th>
            <th scope="col">name</th>
            <th scope="col">update</th>
            <th scope="col">create</th>
            <th scope="col">status code</th>
            <th scope="col">length body</th>
            <th scope="col">header</th>
            <th scope="col">keywords</th>
            <th scope="col">description</th>
        </tr>
  </thead>
  <tbody>
        <tr>
        <th scope="row"><?= $domain->id ?></th>
            <td><?= $domain->name ?></td>
            <td><?= $domain->updated_at ?></td>
            <td><?= $domain->created_at ?></td>
            <td><?= $domain->status_code ?></td>
            <td><?= $domain->contentLength ?? mb_strlen($domain->body) ?></td>
            <td><?= $domain->header ?></td>
            <td><?= $domain->keywords ?></td>
            <td><?= $domain->description ?></td>
        </tr>
@endsection