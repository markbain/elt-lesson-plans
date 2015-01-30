<table> 
    <tr valign="top">
        <th class="metabox_label_column">
            <label for="internet_source">Internet source</label>
        </th>
        <td>
            <input type="text" id="internet_source" name="internet_source" value="<?php echo @get_post_meta($post->ID, 'internet_source', true); ?>" />
        </td>
    <tr>
    <tr valign="top">
        <th class="metabox_label_column">
            <label for="video_duration">Video duration</label>
        </th>
        <td>
            <input type="text" id="video_duration" name="video_duration" value="<?php echo @get_post_meta($post->ID, 'video_duration', true); ?>" />
        </td>
    <tr>
</table>