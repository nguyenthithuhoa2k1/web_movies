<div class="card-comment">
    <div class="card height-unset list-comments mb-4">
        <x-errors />
        <?php
        $movie_id = request()->route('id');
        $dataCommentParent = \App\Helpers\MyHelper::getDataCommentParent($movie_id);
        $currentUser = Auth::user();
        ?>
        @if($dataCommentParent)
            @foreach ($dataCommentParent as $commentParent)
            <?php
                $sumLike = 0;
                $sumDislike = 0;
                $dataLikeComment = \App\Helpers\MyHelper::getLikeComment($commentParent->id, $currentUser->id);
                $like = $dataLikeComment ? $dataLikeComment['like'] : 0;
                $dislike = $dataLikeComment ? $dataLikeComment['dislike'] : 0;

                $sumLike = \App\Helpers\MyHelper::getSumLikeComment($commentParent->id);
                $sumDislike = \App\Helpers\MyHelper::getSumDislikeComment($commentParent->id);
            ?>
                <div class="card-body">
                    <div class="d-flex flex-start align-items-center">
                        <img class="rounded-circle shadow-1-strong me-3"
                            src="{{ asset('storage/upload/user_image/'.$commentParent->image) }}" alt="Avatar"
                            width="60" height="60">
                        <div>
                            <h6 class="fw-bold text-primary mb-1">{{ $commentParent->name }}</h6>
                            <p>Shared {{ $commentParent->created_at->format('d M, Y') }}</p>
                        </div>
                    </div>
                    <div class="comment-items">
                        <pre class="mt-1 mb-2 pb-2">{{ $commentParent->comment }}</pre>
                    </div>
                    <div>
                        <div class="d-flex justify-content-start">
                            <form class="like-comment " method="post" action="{{ url('/movie/like') }}"
                                class="d-flex flex-row align-items-center">
                                @csrf
                                <input type="hidden" class="comment_id" value="{{ $commentParent->id }}">
                                <button type="submit" class="btn btn-sm me-2 {{ $like == 1 ? 'btn-primary' : 'btn-outline-primary' }}">Like</button>
                            </form>
                            <form class="dislike-comment" method="post" action="{{ url('/movie/dislike') }}"
                                class="d-flex flex-row align-items-center">
                                @csrf
                                <input type="hidden" class="comment_id" value="{{ $commentParent->id }}">
                                <button type="submit" class=" dislike submit btn btn-sm me-2 {{ $dislike == 1 ? 'btn-primary' : 'btn-outline-primary' }}">Dislike</button>
                            </form>
                            <button class="reply btn btn-sm me-2 btn-outline-primary" data-id-comment = "{{$commentParent->id}}">Reply</button>
                        </div>
                        <div class="d-flex justify-content-end">
                            <p class="badge bg-primary rounded-pill me-2 sum-like-{{ $commentParent->id }}">{{ $sumLike }} Likes</p>
                            <p class="badge bg-primary rounded-pill sum-dislike-{{ $commentParent->id }}">{{ $sumDislike }} Dislikes</p>
                        </div>
                        <?php
                            $movie_id = request()->route('id');
                            $level = $commentParent->id;
                            $dataCommentReply = \App\Helpers\Myhelper::getDataCommentReply($movie_id,$level);
                        ?>
                        <div class="card-body-reply-{{$level}} ms-5 hide">
                        @foreach($dataCommentReply as $commentReply)
                        <?php
                            $sumLike = 0;
                            $sumDislike = 0;
                            $dataLikeComment = \App\Helpers\MyHelper::getLikeCommentReply($commentReply->id, $currentUser->id);
                            $like = $dataLikeComment ? $dataLikeComment['like'] : 0;
                            $dislike = $dataLikeComment ? $dataLikeComment['dislike'] : 0;

                            $sumLike = \App\Helpers\MyHelper::getSumLikeComment($commentReply->id);
                            $sumDislike = \App\Helpers\MyHelper::getSumDislikeComment($commentReply->id);
                        ?>
                            <div class="d-flex flex-start align-items-center mb-3">
                            <img class="rounded-circle shadow-1-strong me-3" src="{{ asset('storage/upload/user_image/'.$commentReply->image)}}" alt="Avatar" width="60" height="60">
                            <div>
                                <h6 class="fw-bold text-primary mb-1">{{$commentReply->name}}</h6>
                                <p>Shared {{ $commentParent->created_at->format('d M, Y') }}</p>
                            </div>
                            </div>
                            <div class="comment-items">
                                <pre class="mt-3 mb-4 pb-2">{{$commentReply->comment}}</pre>
                            </div>
                            <div>
                                <div class="d-flex justify-content-start">
                                    <form class="like-comment " method="post" action="{{ url('/movie/like') }}"
                                        class="d-flex flex-row align-items-center">
                                        @csrf
                                        <input type="hidden" class="comment_id" value="{{ $commentReply->id }}">
                                        <button type="submit" class="btn btn-sm me-2 {{ $like == 1 ? 'btn-primary' : 'btn-outline-primary' }}">Like</button>
                                    </form>
                                    <form class="dislike-comment" method="post" action="{{ url('/movie/dislike') }}"
                                        class="d-flex flex-row align-items-center">
                                        @csrf
                                        <input type="hidden" class="comment_id" value="{{ $commentReply->id }}">
                                        <button type="submit" class=" dislike submit btn btn-sm me-2 {{ $dislike == 1 ? 'btn-primary' : 'btn-outline-primary' }}">Dislike</button>
                                    </form>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <p class="badge bg-primary rounded-pill me-2 sum-like-{{ $commentReply->id }}">{{ $sumLike }} Likes</p>
                                    <p class="badge bg-primary rounded-pill sum-dislike-{{ $commentReply->id }}">{{ $sumDislike }} Dislikes</p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <form class="hide comment-reply" method="post" id="formCommentReply-{{$commentParent->id}}" action="{{ url('/movie/comment/reply') }}"
                            class=" card card-body bg-light height-unset p-2">
                            @csrf
                            <input type="hidden" name="id" value="{{$commentParent->id}}">
                            <div class="d-flex flex-start w-100">
                                <img class="rounded-circle shadow-1-strong me-3"
                                    src="{{ asset('storage/upload/user_image/'.$currentUser->image) }}" alt="avatar" width="40"
                                    height="40" />
                                <div class="form-outline w-100">
                                    <input name="comment" class="form-control comment" id="textAreaExample" rows="4"
                                        placeholder="Nhập bình luận của bạn" style="background: #fff;">
                                    <label class="form-label" for="textAreaExample">Message</label>
                                </div>
                            </div>
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary btn-sm">Post comment</button>
                                <button type="button" class="btn btn-outline-primary btn-sm ms-1">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
    {{ $dataCommentParent->links('pagination::bootstrap-4') }}
    <form method="post" id="form_comment" action="{{ url('/movie/comment') }}"
        class=" card card-body bg-light height-unset p-2">
        @csrf
        <div class="d-flex flex-start w-100">
            <img class="rounded-circle shadow-1-strong me-3"
                src="{{ asset('storage/upload/user_image/'.$currentUser->image) }}" alt="avatar" width="40"
                height="40" />
            <div class="form-outline w-100">
                <textarea name="comment" class="form-control comment" id="textAreaExample" rows="4"
                    placeholder="Nhập bình luận của bạn" style="background: #fff;"></textarea>
                <label class="form-label" for="textAreaExample">Message</label>
            </div>
        </div>
        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-primary btn-sm">Post comment</button>
            <button type="button" class="btn btn-outline-primary btn-sm ms-1">Cancel</button>
        </div>
    </form>
</div>
<script>
    $(document).ready(function() {
        var csrfToken = $("meta[name='csrf-token']").attr("content");
        $(document).on('submit', 'form#form_comment', function(e) {
            e.preventDefault();
            var comment = $(this).find('.comment').val();
            var movie_id = "{{ $movie_id }}";
            $('.form-outline').find('textarea').val('');
            $.ajax({
                method: "POST",
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                url: $(this).attr('action'), //k co html va chi chay ngầm
                dataType: 'json',
                data: {
                    "movie_id": movie_id,
                    "comment": comment,
                },
                success: function(res) {
                    var data = res.dataComment;
                    var dataUser = res.dataUser;
                    var createdAt = new Date(data.created_at);
                    var formattedDate = createdAt.toLocaleDateString("en-GB", {
                        month: "short",
                        day: "numeric",
                        year: "numeric",
                    });
                    if (data) {
                        let html = `
                            <div class="card-body">
                                <div class="d-flex flex-start align-items-center mb-3">
                                <img class="rounded-circle shadow-1-strong me-3" src="{{ asset('storage/upload/user_image/')}}/${dataUser.image}" alt="Avatar" width="60" height="60">
                                <div>
                                    <h6 class="fw-bold text-primary mb-1">${dataUser.name}</h6>
                                    <p>Shared ${formattedDate}</p>
                                </div>
                                </div>
                                <div class="comment-items">
                                    <pre class="mt-3 mb-4 pb-2">${data.comment}</pre>
                                </div>
                                <div>
                                    <div class="d-flex justify-content-start">
                                        <form class="like-comment" method="post" action="{{ url('/movie/like') }}"
                                            class="d-flex flex-row align-items-center">
                                            @csrf
                                            <input type="hidden" class="comment_id" value="${data.id}">
                                            <button type="submit" class=" btn btn-sm me-2 btn-outline-primary ">Like</button>
                                        </form>
                                        <form class="dislike-comment" method="post" action="{{ url('/movie/dislike') }}"
                                            class="d-flex flex-row align-items-center">
                                            @csrf
                                            <input type="hidden" class="comment_id" value="${data.id}">
                                            <button type="submit" class=" dislike btn btn-sm me-2 btn-outline-primary ">Dislike</button>
                                        </form>
                                        <button class="reply btn btn-sm me-2 btn-outline-primary" data-id-comment = "${data.id}">Reply</button>
                                    </div>
                                    <div class="d-flex justify-content-end">
                                        <p class="badge me-2 bg-primary rounded-pill sum-like-${data.id}">0 Likes</p>
                                        <p class="badge bg-primary rounded-pill sum-dislike-${data.id}"">0 Dislikes</p>
                                    </div>
                                    <div class="card-body-reply-${data.id} ms-5 hide">
                                    </div>
                                </div>
                            </div>
                            <form class=" hide comment-reply" method="post" id="formCommentReply-${data.id}" action="{{ url('/movie/comment/reply') }}"
                                class=" card card-body bg-light height-unset p-2">
                                @csrf
                                <input type="hidden" name="id" value="${data.id}">
                                <div class="d-flex flex-start w-100">
                                    <img class="rounded-circle shadow-1-strong me-3"
                                        src="{{ asset('storage/upload/user_image/') }}/${dataUser.image}" alt="avatar" width="40"
                                        height="40" />
                                    <div class="form-outline w-100">
                                        <input name="comment" class="form-control comment" id="textAreaExample" rows="4"
                                            placeholder="Nhập bình luận của bạn" style="background: #fff;">
                                        <label class="form-label" for="textAreaExample">Message</label>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary btn-sm">Post comment</button>
                                    <button type="button" class="btn btn-outline-primary btn-sm ms-1">Cancel</button>
                                </div>
                            </form>
                        `;
                        $(".card-comment > .list-comments").append(html);
                    }
                }
            });
        });
        $(document).on('submit', 'form.like-comment', function(e) {
            e.preventDefault();
            let form = $(this);
            let comment_id = form.find('.comment_id').val();
            $.ajax({
                method: "POST",
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                url: form.attr('action'), //k co html va chi chay ngầm
                dataType: 'json',
                data: {
                    "comment_id": comment_id,
                },
                success: function(res) {
                    let dislike = $(`.sum-dislike-${comment_id}`).text().split(' ')[0];
                    let like = $(`.sum-like-${comment_id}`).text().split(' ')[0];
                    if (res.flag == true) {
                        form.find("button[type='submit']").addClass('btn-primary');
                        form.find("button[type='submit']").removeClass('btn-outline-primary');
                        $(`.sum-like-${comment_id}`).text((parseInt(like) + 1) + ' Like');

                        let btnDislike = form.closest('.card-body').find('form.dislike-comment').find("button[type='submit']");
                        btnDislike.removeClass('btn-primary');
                        btnDislike.addClass('btn-outline-primary');
                        if(dislike > 0) {
                            $(`.sum-dislike-${comment_id}`).text((parseInt(dislike) - 1) + ' Dislike');
                        }
                    } else {
                        form.find("button[type='submit']").removeClass('btn-primary');
                        form.find("button[type='submit']").addClass('btn-outline-primary');
                        if(like > 0) {
                            $(`.sum-like-${comment_id}`).text((parseInt(like) - 1) + ' Like');
                        }
                    }
                }
            });
        });
        $(document).on('submit', 'form.dislike-comment', function(e) {
            e.preventDefault();
            let form = $(this);
            let comment_id = form.find('.comment_id').val();
            $.ajax({
                method: "POST",
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                url: form.attr('action'), //k co html va chi chay ngầm
                dataType: 'json',
                data: {
                    "comment_id": comment_id,
                },
                success: function(res) {
                    let dislike = $(`.sum-dislike-${comment_id}`).text().split(' ')[0];
                    let like = $(`.sum-like-${comment_id}`).text().split(' ')[0];
                    if (res.flag == true) {
                        form.find("button[type='submit']").addClass('btn-primary');
                        form.find("button[type='submit']").removeClass('btn-outline-primary');
                        $(`.sum-dislike-${comment_id}`).text((parseInt(dislike) + 1) + ' Dislike');

                        let btnLike = form.closest('.card-body').find('form.like-comment').find("button[type='submit']");
                        btnLike.removeClass('btn-primary');
                        btnLike.addClass('btn-outline-primary');
                        if(like > 0) {
                            $(`.sum-like-${comment_id}`).text((parseInt(like) - 1) + ' Like');
                        }
                    } else {
                        form.find("button[type='submit']").removeClass('btn-primary');
                        form.find("button[type='submit']").addClass('btn-outline-primary');
                        if(dislike > 0) {
                            $(`.sum-dislike-${comment_id}`).text((parseInt(dislike) - 1) + ' Dislike');
                        }
                    }
                }
            });
        });
        $(document).on('click', 'button.reply',function(){
            var commentParentId = $(this).attr('data-id-comment');
            var cardComment = $(this).closest('.card-comment');
            cardComment.find('#formCommentReply-'+ commentParentId).toggleClass('hide');
            cardComment.find('.card-body-reply-'+ commentParentId).toggleClass('hide');
        });
        $(document).on('submit', 'form.comment-reply', function(e) {
            e.preventDefault();
            var commentParentId = $(this).find("input[name='id']").val();
            var comment = $(this).find('.comment').val();
            var movie_id = "{{ $movie_id }}";
            $('.form-outline').find('input').val('');
            $.ajax({
                method: "POST",
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                url: $(this).attr('action'), //k co html va chi chay ngầm
                dataType: 'json',
                data: {
                    "movie_id": movie_id,
                    "comment": comment,
                    'commentParentId': commentParentId,
                },
                success: function(res) {
                    var data = res.dataCommentReply;
                    var dataUser = res.dataUser;
                    var createdAt = new Date(data.created_at);
                    var formattedDate = createdAt.toLocaleDateString("en-GB", {
                        month: "short",
                        day: "numeric",
                        year: "numeric",
                    });
                    if (data) {
                        let html = `
                            <div class="d-flex flex-start align-items-center mb-3">
                            <img class="rounded-circle shadow-1-strong me-3" src="{{ asset('storage/upload/user_image/')}}/${dataUser.image}" alt="Avatar" width="60" height="60">
                            <div>
                                <h6 class="fw-bold text-primary mb-1">${dataUser.name}</h6>
                                <p>Shared ${formattedDate}</p>
                            </div>
                            </div>
                            <div class="comment-items">
                                <pre class="mt-3 mb-4 pb-2">${data.comment}</pre>
                            </div>
                            <div>
                                <div class="d-flex justify-content-start">
                                    <form class="like-comment " method="post" action="{{ url('/movie/like') }}">
                                        @csrf
                                        <input type="hidden" class="comment_id" value="${data.id}">
                                        <button type="submit" class=" btn btn-sm me-2 btn-outline-primary ">Like</button>
                                    </form>
                                    <form class="dislike-comment" method="post" action="{{ url('/movie/dislike') }}">
                                        @csrf
                                        <input type="hidden" class="comment_id" value="${data.id}">
                                        <button type="submit" class=" dislike btn btn-sm me-2 btn-outline-primary ">Dislike</button>
                                    </form>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <p class="badge bg-primary rounded-pill me-2 sum-like-${data.id}">0 Likes</p>
                                    <p class="badge bg-primary rounded-pill sum-dislike-${data.id}">0 Dislikes</p>
                                </div>
                            </div>
                        `;
                        $(".card-comment .card-body-reply-" + commentParentId).append(html);
                    }
                }
            });
        });
    });
</script>
