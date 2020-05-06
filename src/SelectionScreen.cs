using System;
using System.Text;
using System.Collections;
using System.Collections.Generic;


/// <summary>
/// 
/// </summary>
public class SelectionScreen
{

  #region Attributes

  /// <summary>
  /// A singleton instance of the class
  /// </summary>
  private static SelectionScreen selectionScreen = null;

  #endregion


  #region Public methods

  /// <summary>
  /// Redraws all elements of the GUI updating all the elements with the proper
  /// contents
  /// </summary>
  /// <returns></returns>
  public void RefreshScreen()
  {
    throw new Exception("The method or operation is not implemented.");
  }

  /// <summary>
  /// A function to get the singleton instance of the class, or create it if id doesnt
  /// exist.
  /// </summary>
  /// <returns>SelectionScreen</returns>
  public static SelectionScreen SelectionScreenInstance()
  {
       if (selectionScreen == null)
       {
             selectionScreen = new SelectionScreen();
       }
       return selectionScreen;     
  }

  #endregion



  #region Private methods

  /// <summary>
  /// A private constructor.
  /// </summary>
  /// <returns></returns>
  private SelectionScreen()
  {
        RefreshScreen();
  }

  #endregion


}

