<?php
/**
 * File containing the ezp\Persistence\Content\Query\Criterion\ContentId class
 *
 * @copyright Copyright (C) 1999-2012 eZ Systems AS. All rights reserved.
 * @license http://www.gnu.org/licenses/gpl-2.0.txt GNU General Public License v2
 * @version //autogentag//
 *
 */

namespace ezp\Persistence\Content\Query\Criterion;
use ezp\Persistence\Content\Query\Criterion,
    ezp\Persistence\Content\Query\Criterion\Operator\Specifications,
    ezp\Persistence\Content\Query\CriterionInterface;

/**
 * A criterion that matches content based on its id
 *
 * Supported operators:
 * - IN: will match from a list of ContentId
 * - EQ: will match against one ContentId
 */
class ContentId extends Criterion implements CriterionInterface
{
    /**
     * Creates a new ContentId criterion
     *
     * @param integer|array(integer) One or more content Id that must be matched.
     *
     * @throw InvalidArgumentException if a non numeric id is given
     * @throw InvalidArgumentException if the value type doesn't match the operator
     */
    public function __construct( $value )
    {
        parent::__construct( null, null, $value );
    }

    public function getSpecifications()
    {
        $types = Specifications::TYPE_INTEGER | Specifications::TYPE_STRING;
        return array(
            new Specifications( Operator::IN, Specifications::FORMAT_ARRAY, $types ),
            new Specifications( Operator::EQ, Specifications::FORMAT_SINGLE, $types ),
        );
    }

    public static function createFromQueryBuilder( $target, $operator, $value )
    {
        return new self( $value );
    }
}
?>
