<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <link rel="stylesheet" href="css/reset.css">
  <link rel="stylesheet" href="css/style.css">

  <title>find</title>
</head>
<body>
  <div class="list">
    <div class="flex">
    <h1 class="box">タスク検索</h1>

    <div class="box">
    <p class="user_inf">「{{$user->name }}」でログイン中</p>

    <form action="/logout" method="POST">
      @csrf
      <button type="submit" class="logout_bottun">ログアウト</button>
      </form>
</div>
</div>



    @if (count($errors) > 0)
    <ul>
    @foreach ($errors->all() as $error)
      <li>
        {{$error}}
      </li>
    @endforeach
    </ul>
    @endif
    <form action="/search" method="POST" class="add">
      @csrf
      
    <input type="text" name="task" class="add_text">
    <select name="tag_id" class="tag_add">
      <option value='0'></option>
      @foreach ($tags->all() as $tag)
        <option value="{{$tag->id}}">{{$tag->tag}}</option>
        @endforeach
      </select>
      <input type="hidden" name="user_id" value="{{$user->id}}">
    <button class="add_bottun">検索</button>
    <!--
    <button type="submit" name="add">追加</button>
-->
    </form>
    <table>
    @csrf
      <tr>
        <th  class="td_text">作成日</th>
        <th  class="td_text">タスク名</th>
        <th  class="td_tag">タグ</th>
        <th  class="td_bottun">更新</th>
        <th  class="td_bottun">削除</th>
        </tr>
@if(@isset($forms))
    @foreach ($forms as $form)
    <form action="/edit" method="POST">
      <tr>
        <td class="td_text">
          {{$form->created_at}}
          <input type="hidden" name="id" value="{{$form->id}}">
          <input type="hidden" name="key" value="key">
        </td>
        <td class="td_text">
          <input type="text" name="task" value="{{$form->task}}" class="edit_text">
        </td>
        <td class="td_tag">
          <select name="tag_id" class="tag_edit">
            @foreach ($tags->all() as $tag)
            @if($tag->id==$form->tag_id)
            <option  value="{{$tag->id}}" selected>{{$tag->tag}}</option>
            @else
            <option  value="{{$tag->id}}">{{$tag->tag}}</option>
            @endif
            @endforeach
          </select>
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
             @endif

    </table>

    <form action="/" method="GET">
      @csrf
      <button type="submit" class="find_bottun">戻る</button>
      </form>




</div>
  
</body>
</html>
