<?php

/* @var $this yii\web\View */
/* @var $posts array */

$this->title = 'Instagram posts API';
?>
<div class="container">
    <div class="page-header text-center">
        <h1 id="timeline">Latest posts</h1>
    </div>
    <ul class="timeline">
        <?php foreach ($posts as $key => $post) :?>
        <li <?php if ($key%2 !== 0):?> class="timeline-inverted" <?php endif?>>
                <div class="timeline-badge primary"><a><i class="glyphicon glyphicon-record" rel="tooltip" title="11 hours ago via Twitter" id=""></i></a></div>
                <div class="timeline-panel">
                    <div class="timeline-heading">
                        <img class="img-responsive" src=" <?= $post['imageUrl'] ?>" />
                    </div>
                    <div class="timeline-body">
                        <p>
                            <?= $post['title'] ?>
                        </p>
                    </div>
                    <div class="timeline-footer">
                        <a><i class="glyphicon glyphicon-thumbs-up"></i><?= $post['likes'] ?></a>
                        <a><i class="glyphicon glyphicon-comment"></i> </i><?= $post['commentsCount'] ?></a>
                        <a><i class="glyphicon glyphicon-time"></i> </i><?= date('Y/m/d H:i', $post['time']) ?></a>
                        <a class="pull-right" href="<?= $post['postUrl'] ?>" target="_blank"><?= $post['owner'] ?></a>
                    </div>
                </div>
        </li>
        <?php endforeach;?>

    </ul>
</div>
