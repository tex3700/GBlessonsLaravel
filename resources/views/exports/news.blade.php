<table>
    <thead>
    <tr>
        <th style="width: 30px"><b>ID</b></th>
        <th style="width: 80px"><b>КАТЕГОРИЯ</b></th>
        <th style="width: 150px"><b>ЗАГОЛОВОК</b></th>
        <th style="width: 400px"><b>СТАТЬЯ</b></th>
        <th style="width: 90px"><b>Приватность</b></th>
    </tr>
    </thead>
    <tbody>
    @foreach($news as $item)
        <tr>
            <td>{{ $item['id'] }}</td>
            <td>{{ $item['category_id'] }}</td>
            <td>{{ $item['title'] }}</td>
            <td>{{ $item['text'] }}</td>
            <td>{{ $item['isPrivate'] }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
