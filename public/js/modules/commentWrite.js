document.addEventListener('DOMContentLoaded', function() {
    const commentField = document.getElementById('comment-write-section');
    const writeCommentBtn = document.getElementById('write-comment-btn');
    const writeCommentContainer = document.getElementById('write-comment-container');
    const closeComment = document.querySelector('.close-comment');

    writeCommentBtn.addEventListener('click', () => {
        commentField.classList.remove(
            'translate-y-full',
            'pointer-events-none'
        );
        commentField.classList.add(
            'translate-y-0',
            'pointer-events-auto'
        );
        setTimeout(() => {
            writeCommentContainer.classList.add('hidden');
        },300);
    });

    closeComment.addEventListener('click', () => {
        writeCommentContainer.classList.remove('hidden');
        commentField.classList.remove(
            'translate-y-0',
            'pointer-events-none'
        );
        commentField.classList.add(
            'translate-y-full',
            'pointer-events-none'
        );
    });

    const submitComment = document.getElementById('submit-comment');
    const VconcernId = document.getElementById('concern-id');
    const VcommentContent = document.getElementById('comment');

    submitComment.addEventListener('click', () => {
        const concernId = VconcernId.value;
        const commentContent = VcommentContent.value;

        if(!concernId) {
            showNotification('Error submitting comment. Some data is missing', 'error');
            return;
        }

        if(!commentContent) {
            showNotification('Please write any comment', 'caution');
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

            showNotification(reply.message, 'success');
            VcommentContent.value = '';
            loadComments(concernId);

            writeCommentContainer.classList.remove('hidden');
            commentField.classList.remove(
                'translate-y-0',
                'pointer-events-none'
            );
            commentField.classList.add(
                'translate-y-full',
                'pointer-events-none'
            );

        }).
        catch(err => {
            console.error(err);
            showNotification('Internal server error', 'error');
        });
    });
});