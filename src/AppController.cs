using System;
using System.Text;
using System.Collections;
using System.Collections.Generic;


/// <summary>
/// 
/// </summary>
public class AppController
{


  #region Attributes

  /// <summary>
  /// A singleton instance of the class.
  /// </summary>
  private static AppController appController = null;


  /// <summary>
  /// Data of a currently logged in user
  /// </summary>
  private LoggedInUser loggedInUser;


  /// <summary>
  /// A reference to all recording data pulled from the input files.
  /// </summary>
  private List<RecordingData> listOfRecordingData;
#endregion


  #region Public methods

  /// <summary>
  /// A function to get the singleton instance of the class, or create it if id doesn't
  /// exist.
  /// </summary>
  /// <returns>AppController</returns>
  public static AppController AppControllerInstance()
  {
       if (appController == null)
       {
              appController = new AppController();
       }
       return appController;     
  }

  /// <summary>
  /// Checks with some sort of user database to determine if the given combination of
  /// login and password are valid. If so it updates the loggedInUser and returns
  /// true. If not it returns false, which results in some sort of messge on the
  /// LoginScreen.
  /// </summary>
  /// <param name="login"></param>
  /// <param name="password"></param>
  /// <returns>bool</returns>
  public bool AuthenticateLogin(string login, string password)
  {
    throw new Exception("The method or operation is not implemented.");
  }

    #endregion



    #region Private methods

    /// <summary>
    /// A private constructor
    /// </summary>
    /// <returns></returns>
    private AppController()
    {

    }

    #endregion


}

