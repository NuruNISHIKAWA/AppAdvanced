<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <link rel="stylesheet" href="css/reset.css">
  <link rel="stylesheet" href="css/style.css">

  <title>ToDoCRUD</title>
</head>
<body>
  <div class="list">
    <h1>Todo List</h1>

    <p>「{{$user->name }}」でログイン中</p>

    <form action="/logout" method="POST">
      @csrf
      <button type="submit" class="edit_bottun">ログアウト</button>
      </form>



    @if (count($errors) > 0)
    <ul>
    @foreach ($errors->all() as $error)
      <li>
        {{$error}}
      </li>
    @endforeach
    </ul>
    @endif
    <form action="/add" method="POST" class="add">
      @csrf
    <input type="text" name="task" class="add_text">
    <button class="add_bottun">追加</button>
    <!--
    <button type="submit" name="add">追加</button>
-->
    </form>

    <table>
    @csrf
      <tr>
        <th  class="td_text">作成日</th>
        <th  class="td_text">タスク名</th>
        <th  class="td_bottun">更新</th>
        <th  class="td_bottun">削除</th>
        </tr>
    @foreach ($todos as $todo)
    <form action="/edit" method="POST">
      <tr>
        <td class="td_text">
          {{$todo->created_at}}
          <input type="hidden" name="id" value="{{$todo->id}}">
        </td>
        <td class="td_text">
          <input type="text" name="task" value="{{$todo->task}}" class="edit_text">
        </td>
        <td class="td_bottun">
          @csrf
          <button type="submit" class="edit_bottun">更新</button>
        </td>
        <td class="td_bottun">
          @csrf
          <button type="submit" formaction="/delete" class="delete_bottun">削除</button>
        </td>
        </tr>
      </form>
    @endforeach
    </table>


    <!--
  <form action="/" method="POST">
    <table>
    @csrf
      <tr>
        <th>作成日</th>
        <th>タスク名</th>
        <th>更新</th>
        <th>削除</th>
        </tr>
    @foreach ($todos as $todo)
      <tr>
        <td>
          {{$todo->created_at}}
        </td>
        <td>
          <input type="text" name="name" value="{{$todo->task}}">
        </td>
        <td>
          <button type="submit" name="update">更新</button>
        </td>
        <td>
          <button type="submit" name="remove">削除</button>
        </td>
        </tr>
    @endforeach
    </table>
  </form>
-->
</div>
  
</body>
</html>
