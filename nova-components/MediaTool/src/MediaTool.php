<?php

namespace Erdenetmc\MediaTool;

use Laravel\Nova\ResourceTool;

class MediaTool extends ResourceTool
{
    /**
     * Get the displayable name of the resource tool.
     *
     * @return string
     */
    public function name()
    {
        return 'Media Tool';
    }

    /**
     * Get the component name for the resource tool.
     *
     * @return string
     */
    public function component()
    {
        return 'media-tool';
    }
}
