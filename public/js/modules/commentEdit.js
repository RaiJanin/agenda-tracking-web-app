import { commentState } from "../state/comment.js";


const comEdContainer = document.getElementById('comment-edit-section');
const uploadEditedCommBtn = document.getElementById('update-comment');
const closeEComment = document.querySelector('.close-edit-comment');

export function renderEdit() {
    
    comEdContainer.classList.remove(
        'translate-y-full',
        'pointer-events-none'
    );
    comEdContainer.classList.add(
        'translate-y-0',
        'pointer-events-auto'
    );

    document.getElementById('edit-comment').value = commentState.commentContent;

}

closeEComment.addEventListener('click', () => {
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
});


    
