-- post_view --

SELECT 
    post.post_id,
    user.user_name,
    post.post_title,
    post.post_content,
    post.post_date,
    COUNT(post_like.post_like_id) AS like_count
FROM 
    post
JOIN 
    user ON post.user_id = user.user_id
LEFT JOIN 
    post_like ON post.post_id = post_like.post_id AND post_like.post_like_active = 1
WHERE 
    post.post_active = 1
GROUP BY 
    post.post_id, user.user_name, post.post_title, post.post_content, post.post_date;