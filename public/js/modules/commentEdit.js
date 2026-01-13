import { updateComment } from "../services/updateComment.js";
import { commentState } from "../state/comment.js";


const comEdContainer = document.getElementById('comment-edit-section');
const uploadEditedCommBtn = document.getElementById('update-comment');
const closeEComment = document.querySelector('.close-edit-comment');
const toEditComment = document.getElementById('edit-comment');

const concernId = document.getElementById('concern-id-data').getAttribute('data-concern-id');

export function renderEdit() {
    
    comEdContainer.classList.remove(
        'translate-y-full',
        'pointer-events-none'
    );
    comEdContainer.classList.add(
        'translate-y-0',
        'pointer-events-auto'
    );

    toEditComment.value = commentState.commentContent;

}

uploadEditedCommBtn.addEventListener('click', () => {
    if(!toEditComment.value) {
        showNotification('Comment Field cannot be empty', 'caution');
        return;
    }

    updateComment(commentState.commentId, toEditComment.value);
    loadComments(concernId);
    closeCommentField();
});

closeEComment.addEventListener('click', () => {
    closeCommentField();
});

function closeCommentField() {
    comEdContainer.classList.remove(
        'translate-y-0',
        'pointer-events-auto'
    );
    comEdContainer.classList.add(
        'translate-y-full',
        'pointer-events-none'
    );
    commentState.commentContent = null;
    commentState.commentId = null;
}


    
