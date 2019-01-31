<?php

namespace Omneo\Bronto\Entities;

use Carbon\Carbon;
use Illuminate\Support\Collection;

class DeliveryField extends AbstractEntity
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $type;

    /**
     * @var string
     */
    protected $content;

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * The name of the API message tag. API message tags can be placed in the body or subject line of an email message
     * with a prepended ‘#’, as in “%%#tag_name%%“). When you reference the name of an API message tag via the API,
     * be sure to leave off the “%%# %%” portion of the API message tag.
     * For example, name => tag_name, rather than name => %%#tag_name%%.
     * Loop tags use a slightly different syntax (%%#tagname_#%%) and can only be added to the body of an email message.
     * When you reference the the name of a Loop tag via the API,
     * be sure to leave off the “%%# %%” portion of the Loop tag,
     * and replace the underscore “_#” with an underscore followed by a number.
     * @param string $name
     * @return DeliveryField
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * The version of the message into which API message tag content should be inserted {text or html}.
     * @param string $type
     * @return DeliveryField
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param string $content
     * @return DeliveryField
     */
    public function setContent($content)
    {
        $this->content = $content;
        return $this;
    }

    /**
     * @return Array
     */
    public function jsonSerialize()
    {
        $result = get_object_vars($this);

        return $result;
    }

}
