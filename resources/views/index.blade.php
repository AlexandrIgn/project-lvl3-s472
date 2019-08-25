@extends('layouts.navbar')

@section('title', 'Domains')

@section('content')
    <table class="table">
        <thead class="thead-light">
        <tr>
            <th scope="col">id</th>
            <th scope="col">name</th>
            <th scope="col">update</th>
            <th scope="col">create</th>
        </tr>
        </thead>
    <?php foreach ($domains as $domain) : ?>
        <tbody>
            <tr>
                <th scope="row"><?= $domain->id ?></th>
                <td><a href="{{ route('domains.show', ['id' => $domain->id]) }}"><?= $domain->name ?></a></td>
                <td><?= $domain->updated_at ?></td>
                <td><?= $domain->created_at ?></td>
            </tr>
        </tbody>
    <?php endforeach; ?>
    </table>
    {{ $domains->links() }}
@endsection