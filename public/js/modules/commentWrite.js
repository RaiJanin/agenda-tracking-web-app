document.addEventListener('DOMContentLoaded', function() {
    const commentField = document.getElementById('comment-write-section');
    const writeCommentBtn = document.getElementById('write-comment-btn');
    const closeComment = document.querySelector('.close-comment');

    writeCommentBtn.addEventListener('click', () => {
        commentField.classList.remove('hidden');
    });

    closeComment.addEventListener('click', () => {
        commentField.classList.add('hidden');
    });

    const submitComment = document.getElementById('submit-comment');
    const VconcernId = document.getElementById('concern-id');
    const VcommentContent = document.getElementById('comment');

    submitComment.addEventListener('click', () => {
        const concernId = VconcernId.value;
        const commentContent = VcommentContent.value;

        if(!concernId) {
            alert('Error submitting comment. Some data is missing');
            return;
        }

        if(!commentContent) {
            alert('Please write any comment');
            return;
        }

        fetch(`/comments/write`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN' : document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept' : 'application/json',
                'Content-type' : 'application/json'
            },
            body: JSON.stringify({
                concern_id: concernId,
                write_comm: commentContent,
            })
        }).
        then(async response => {
            const reply = await response.json();

            alert(reply.message);
            VcommentContent.value = '';
            loadComments(concernId);
        }).
        catch(err => {
            console.error(err);
        });
    });
});