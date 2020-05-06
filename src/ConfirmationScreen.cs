using System;
using System.Text;
using System.Collections;
using System.Collections.Generic;


/// <summary>
/// A windom that shows up after a recording has been selected. It allows the
/// inputing of the RBS scale as well as to select some optional features (for
/// example the name of the csv file to be saved)
/// </summary>
public class ConfirmationScreen
{


  #region Attributes

  /// <summary>
  /// A singleton instance of the class
  /// </summary>
  private static ConfirmationScreen confirmationScreen = null;

    #endregion


    #region Public methods

    /// <summary>
    /// A function to get the singleton instance of the class, or create it if id doesnt
    /// exist.
    /// </summary>
    /// <returns>ConfiramationScreen</returns>
    public static ConfirmationScreen ConfirmationScreenInstance()
    {
        if (confirmationScreen == null)
        {
            confirmationScreen = new ConfirmationScreen();
        }
        return confirmationScreen;
    }


    /// <summary>
    /// Redraws all elements of the GUI updating all the elements with the proper
    /// contents
    /// </summary>
    /// <returns></returns>
    public void RefreshScreen()
  {
  }

  #endregion



  #region Private methods

  /// <summary>
  /// A private constructor.
  /// </summary>
  /// <returns></returns>
  private ConfirmationScreen()
  {
    
  }

  #endregion


}

