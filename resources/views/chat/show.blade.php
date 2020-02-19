@extends('layouts.app')

@push('styles')
    <style type="text/css">
        #users > li {
            cursor: pointer;
        }

    </style>

@endpush

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-8">
                <div class="card">
                    <div class="card-header">Chat</div>


                    <div class="card-body">
                        <div class="row p-2">
                            <div class="col-10">
                                <div class="row">
                                    <div class="col-12 border rounded-lg p-3">
                                        <ul id="messages" class="list-unstyled overflow-auto" style="height: 45vh">
{{--                                            <li>TEST1:HELLO</li>--}}
{{--                                            <li>TEST2:HELLO 2</li>--}}
                                        </ul>
                                    </div>
                                </div>
                                <form action="">
                                    <div class="row py-3">
                                        <div class="col-10">
                                            <input id="message" class="form-control" type="text">
                                        </div>
                                        <div class="col-2">
                                            <button id="send" class="btn btn-primary btn-block" type="submit">Send
                                            </button>
                                        </div>
                                    </div>
                                </form>

                            </div>
                            <div class="col-2">
                                <p><strong>Online Now /上線中</strong></p>
                                <ul id="users" class="list-unstyled overflow-auto text-info" style="height: 45vh">
{{--                                    <li>Test1</li>--}}
{{--                                    <li>Test2</li>--}}
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('scripts')
    <script>
        const usersElement = document.getElementById('users');
        const messagesElement = document.getElementById('messages');



        Echo.join('chat')
            // here第一次連接進去 show 當前狀況而已，後面新增或者離開，則要利用joining(),leaving()
            .here((users)=>{
                users.forEach((user,index)=>{
                    let element = document.createElement('li');
                    element.setAttribute('id',user.id);
                    // element.setAttribute('onclick',greetUser('${user.id}'));

                    element.addEventListener('click', (e)=>{
                        greetUser(user.id);
                    });

                    element.innerText = user.name;
                    usersElement.appendChild(element);
                });
            })

            // 偵測後來進來的使用者
            .joining((user)=>{
                let element = document.createElement('li');
                element.setAttribute('id',user.id);
                // element.setAttribute('onclick',greetUser('${user.id}'));
                element.addEventListener('click', (e)=>{
                    greetUser(user.id);
                });
                element.innerText = user.name;
                usersElement.appendChild(element);
            })

            //偵測離開的使用者
            .leaving((user)=>{
                const element = document.getElementById(user.id);
                element.parentNode.removeChild(element);
            })

            .listen('MessageSent',(e)=>{
                let element = document.createElement('li');
                element.innerText = e.user.name + ': ' + e.message;
                messagesElement.appendChild(element);


            });

    </script>


    <script>

        const messageElement = document.getElementById('message');
        const sendElement = document.getElementById('send');

        sendElement.addEventListener('click',(e)=>{
            e.preventDefault(); //阻止提交表單發生默認行為
            window.axios.post('/chat/message',{
                message: messageElement.value,
            });
            messageElement.value = '';
        });

    </script>

    <script>
        function greetUser(id) {
            console.log('click ok');
            window.axios.post('/chat/greet/' + id);
        }
    </script>



@endpush
