<div class="main-feed">
    <?php if (!empty($events)): ?>
        <?php foreach ($events as $event): ?>
            <div class="main-feed-item">
                <article class="common-post">
                    <header class="common-post-header u-flex">
                        <!-- User Image -->
                        <img src="<?php echo $this->Html->url('/' . $event['Event']['profile_picture']); ?>" class="user-image" width="40" height="40" alt="User Image">

                        <div class="common-post-info">
                            <div class="user-and-group u-flex">
                                <!-- User Name and Event Title -->
                                <a href="/MessageBoard/user-profile/<?= h($event['Event']['user_id']); ?>" class="user-name"><?= h($event['Event']['title']); ?></a>
                            </div>
                            <div class="time-and-privacy">
                                <!-- Time and Event Type -->
                                <time datetime="<?= h($event['Event']['created_at']); ?>" class="event-time">
                                    <?= date('F j, Y, g:i a', strtotime($event['Event']['created_at'])); ?>
                                </time>
                                <span class="icon icon-privacy"><?= h($event['Event']['event_type']); ?></span>
                            </div>
                        </div>
                    </header>
                    
                    <!-- Event Content -->
                    <div class="common-post-content common-content">
                        <?= h($event['Event']['description']); ?>

                        <div class="event-details">
                            <!-- Event Location -->
                            <?php if (!empty($event['Event']['location'])): ?>
                                <p class="event-location"><strong>Location:</strong> <?= h($event['Event']['location']); ?></p>
                            <?php endif; ?>

                            <!-- Event Start and End Time -->
                            <?php if (!empty($event['Event']['start_time'])): ?>
                                <p><strong>Start Time:</strong> <?= date('F j, Y, g:i a', strtotime($event['Event']['start_time'])); ?></p>
                            <?php endif; ?>

                            <?php if (!empty($event['Event']['end_time'])): ?>
                                <p><strong>End Time:</strong> <?= date('F j, Y, g:i a', strtotime($event['Event']['end_time'])); ?></p>
                            <?php endif; ?>
                        </div> 

                        <!-- Event Image (if available) -->
                        <?php if (!empty($event['Event']['image_path'])): ?>
                            <div class="event-image">
                                <img src="<?= h($event['Event']['image_path']); ?>" alt="Event Image" class="image">
                            </div>
                        <?php endif; ?>
                    </div>
                </article>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No events to display.</p>
    <?php endif; ?>
</div>

<style>
    .main-feed {
        max-width: 800px;
        margin: 0 auto;
        padding: 15px;
    }

    .main-feed-item {
        background-color: #fff;
        border-radius: 8px;
        margin-bottom: 15px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .common-post-header {
        display: flex;
        align-items: center;
        padding: 15px;
        border-bottom: 1px solid #ddd;
    }

    .user-image {
        border-radius: 50%;
        margin-right: 15px;
    }

    .common-post-info {
        flex-grow: 1;
    }

    .user-name {
        font-size: 16px;
        font-weight: bold;
        color: #1c1e21;
        text-decoration: none;
    }

    .user-name:hover {
        text-decoration: underline;
    }

    .time-and-privacy {
        display: flex;
        justify-content: space-between;
        font-size: 12px;
        color: #65676b;
    }

    .event-time {
        color: #65676b;
    }

    .event-details {
        margin-top: 10px;
        font-size: 14px;
    }

    .event-location {
        color: #1c1e21;
        font-weight: bold;
    }

    .event-image {
        margin-top: 15px;
        max-width: 100%;
        border-radius: 8px;
        overflow: hidden;
    }

    .event-image img {
        width: 100%;
        height: auto;
        border-radius: 8px;
    }

    .common-post-content {
        padding: 15px;
        font-size: 14px;
        color: #1c1e21;
    }

    .icon-privacy {
        font-size: 14px;
        color: #65676b;
        margin-left: 5px;
    }
</style>
