<?php /** @copyright Alejandro Salazar (c) 2016 */
namespace Math\Combinatorics;

/**
 * The <kbd>PermutationTest</kbd> test suite for the <kbd>Permutation</kbd> class.
 *
 * @author Alejandro Salazar (alejandros@pley.com)
 * @category   Math
 * @version    1.0
 * @license    http://www.gnu.org/licenses/lgpl-3.0.en.html GNU LGPLv3
 * @link       https://github.com/alphazygma/Math
 * @package    Math
 * @subpackage Combinatorics
 */
class PermutationTest extends \PHPUnit_Framework_TestCase
{
    private $_sourceDataSetKey = ['z' => 10, 'a' => 50, 'x' => 77];
    private $_sourceDataSetIdx = [10, 50, 77];
    
    public function testPermutationInstance()
    {
        $permutation = new Permutation();
        
        // Size 0 permutations ---------------------------------------------------------------------
        $permutationList0 = $permutation->getPermutations($this->_sourceDataSetKey, 0);
        $expectedPermutationList0 = [];
        $this->_assertPermutation($permutationList0, $expectedPermutationList0, 0);
        
        
        // Size 1 permutations ---------------------------------------------------------------------
        $permutationList1 = $permutation->getPermutations($this->_sourceDataSetKey, 1);
        $expectedPermutationList1 = [
            ['z' => 10], ['a' => 50], ['x' => 77],
        ];
        $this->_assertPermutation($permutationList1, $expectedPermutationList1, 3);
        
        // If this test pass, we don't need to check for other Index arrays as it proves that the
        // combination is still treated as a map and thus if the key arrays tests pass, so would the
        // indexed arrays
        $permutationIdxList1 = $permutation->getPermutations($this->_sourceDataSetIdx, 1);
        $expectedPermutationIdxList1 = [
            [0 => 10], [1 => 50], [2 => 77],
        ];
        $this->_assertPermutation($permutationIdxList1, $expectedPermutationIdxList1, 3);
        
        
        // Size 3 combinations ---------------------------------------------------------------------
        $permutationList3 = $permutation->getPermutations($this->_sourceDataSetKey, 3);
        $expectedPermutationList3 = [
            ['z' => 10, 'a' => 50, 'x' => 77],
            ['z' => 10, 'x' => 77, 'a' => 50],
            ['a' => 50, 'x' => 77, 'z' => 10],
            ['a' => 50, 'z' => 10, 'x' => 77],
            ['x' => 77, 'z' => 10, 'a' => 50],
            ['x' => 77, 'a' => 50, 'z' => 10],
        ];
        $this->_assertPermutation($permutationList3, $expectedPermutationList3, 6);
        
        
        // All combinations ------------------------------------------------------------------------
        $permutationList = $permutation->getPermutations($this->_sourceDataSetKey);
        $expectedPermutationList = [
            ['z' => 10],
            ['a' => 50],
            ['x' => 77],
            ['z' => 10, 'a' => 50],
            ['a' => 50, 'z' => 10],
            ['z' => 10, 'x' => 77],
            ['x' => 77, 'z' => 10],
            ['a' => 50, 'x' => 77],
            ['x' => 77, 'a' => 50],
            ['z' => 10, 'a' => 50, 'x' => 77],
            ['z' => 10, 'x' => 77, 'a' => 50],
            ['a' => 50, 'x' => 77, 'z' => 10],
            ['a' => 50, 'z' => 10, 'x' => 77],
            ['x' => 77, 'z' => 10, 'a' => 50],
            ['x' => 77, 'a' => 50, 'z' => 10],
        ];
        $this->_assertPermutation($permutationList, $expectedPermutationList, 15);
    }
    
    public function testPermutationStatic()
    {
        // Size 0 permutations ---------------------------------------------------------------------
        $permutationList0 = Permutation::get($this->_sourceDataSetKey, 0);
        $expectedPermutationList0 = [];
        $this->_assertPermutation($permutationList0, $expectedPermutationList0, 0);
        
        
        // Size 1 permutations ---------------------------------------------------------------------
        $permutationList1 = Permutation::get($this->_sourceDataSetKey, 1);
        $expectedPermutationList1 = [
            ['z' => 10], ['a' => 50], ['x' => 77],
        ];
        $this->_assertPermutation($permutationList1, $expectedPermutationList1, 3);
        
        // If this test pass, we don't need to check for other Index arrays as it proves that the
        // combination is still treated as a map and thus if the key arrays tests pass, so would the
        // indexed arrays
        $permutationIdxList1 = Permutation::get($this->_sourceDataSetIdx, 1);
        $expectedPermutationIdxList1 = [
            [0 => 10], [1 => 50], [2 => 77],
        ];
        $this->_assertPermutation($permutationIdxList1, $expectedPermutationIdxList1, 3);
        
        
        // Size 3 combinations ---------------------------------------------------------------------
        $permutationList3 = Permutation::get($this->_sourceDataSetKey, 3);
        $expectedPermutationList3 = [
            ['z' => 10, 'a' => 50, 'x' => 77],
            ['z' => 10, 'x' => 77, 'a' => 50],
            ['a' => 50, 'x' => 77, 'z' => 10],
            ['a' => 50, 'z' => 10, 'x' => 77],
            ['x' => 77, 'z' => 10, 'a' => 50],
            ['x' => 77, 'a' => 50, 'z' => 10],
        ];
        $this->_assertPermutation($permutationList3, $expectedPermutationList3, 6);
        
        
        // All combinations ------------------------------------------------------------------------
        $permutationList = Permutation::get($this->_sourceDataSetKey);
        $expectedPermutationList = [
            ['z' => 10],
            ['a' => 50],
            ['x' => 77],
            ['z' => 10, 'a' => 50],
            ['a' => 50, 'z' => 10],
            ['z' => 10, 'x' => 77],
            ['x' => 77, 'z' => 10],
            ['a' => 50, 'x' => 77],
            ['x' => 77, 'a' => 50],
            ['z' => 10, 'a' => 50, 'x' => 77],
            ['z' => 10, 'x' => 77, 'a' => 50],
            ['a' => 50, 'x' => 77, 'z' => 10],
            ['a' => 50, 'z' => 10, 'x' => 77],
            ['x' => 77, 'z' => 10, 'a' => 50],
            ['x' => 77, 'a' => 50, 'z' => 10],
        ];
        $this->_assertPermutation($permutationList, $expectedPermutationList, 15);
    }
    
    private function _assertPermutation($permutationList, $expectedPermutationList, $expectedCount)
    {
        // There should be N combinations
        $this->assertCount($expectedCount, $permutationList);
        
        foreach ($expectedPermutationList as $index => $expectedCombination) {
            // The comparison should also be done in the same order
            $compareCombination = $permutationList[$index];
            
            foreach ($expectedCombination as $expectedKey => $expectedValue) {
                $compareKey   = key($compareCombination);
                $compareValue = current($compareCombination);

                $this->assertEquals($expectedKey, $compareKey);
                $this->assertEquals($expectedValue, $compareValue);
                
                // advancing the pointer on the compare combination as well
                next($compareCombination);
            }
            
            reset($compareCombination);
        }
    }
}
