USE [clsms]
GO
/****** Object:  Table [dbo].[Categorize_Serials]    Script Date: 16/10/2018 11:13:37 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Categorize_Serials](
	[DepartmentID] [varchar](10) NOT NULL,
	[SerialID] [int] NOT NULL,
	[CategoryID] [int] IDENTITY(1,1) NOT NULL,
 CONSTRAINT [PK_Categorize_Serials] PRIMARY KEY CLUSTERED 
(
	[CategoryID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[Delivery]    Script Date: 16/10/2018 11:13:37 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Delivery](
	[DeliveryID] [int] IDENTITY(1,1) NOT NULL,
	[SerialID] [int] NOT NULL,
	[DateofIssue] [date] NULL,
	[IssueNumber] [varchar](50) NULL,
	[VolumeNumber] [varchar](50) NULL,
	[Copies] [int] NOT NULL,
	[Receive_Date] [date] NULL,
 CONSTRAINT [PK_Delivery] PRIMARY KEY CLUSTERED 
(
	[DeliveryID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[Department]    Script Date: 16/10/2018 11:13:37 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Department](
	[DepartmentID] [varchar](10) NOT NULL,
	[DepartmentName] [varchar](50) NOT NULL,
 CONSTRAINT [PK_Department] PRIMARY KEY CLUSTERED 
(
	[DepartmentID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[Distributor]    Script Date: 16/10/2018 11:13:37 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Distributor](
	[DistributorID] [int] IDENTITY(1,1) NOT NULL,
	[DistributorName] [varchar](50) NOT NULL,
	[NameOfIncharge] [varchar](50) NOT NULL,
	[ContactNumber] [varchar](25) NOT NULL,
	[Email] [varchar](50) NULL,
	[Distributor_Type] [varchar](50) NOT NULL,
 CONSTRAINT [PK_Distributor] PRIMARY KEY CLUSTERED 
(
	[DistributorID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[Notification]    Script Date: 16/10/2018 11:13:37 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Notification](
	[NotificationID] [int] IDENTITY(1,1) NOT NULL,
	[SerialID] [int] NOT NULL,
	[NotificationType] [varchar](100) NOT NULL,
	[NotificationSeen] [varchar](50) NOT NULL,
	[Date_Receive_RedFlag] [date] NOT NULL,
 CONSTRAINT [PK_Notification] PRIMARY KEY CLUSTERED 
(
	[NotificationID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[ReceiveSerial]    Script Date: 16/10/2018 11:13:37 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[ReceiveSerial](
	[ReceivedSerialID] [int] IDENTITY(1,1) NOT NULL,
	[DepartmentID] [varchar](10) NOT NULL,
	[SerialID] [int] NOT NULL,
	[Status] [varchar](50) NOT NULL,
	[DateReceiveNotif_Give] [date] NOT NULL,
	[ControlNumber] [varchar](50) NULL,
	[RS_Seen] [varchar](7) NULL,
	[Staff_Comment] [varchar](100) NULL,
	[RS_Type] [varchar](20) NULL,
 CONSTRAINT [PK_ReceiveSerial] PRIMARY KEY CLUSTERED 
(
	[ReceivedSerialID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[Serial]    Script Date: 16/10/2018 11:13:37 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Serial](
	[SerialID] [int] IDENTITY(1,1) NOT NULL,
	[TypeID] [int] NULL,
	[SerialName] [varchar](50) NOT NULL,
 CONSTRAINT [PK_Serial] PRIMARY KEY CLUSTERED 
(
	[SerialID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[Subscription]    Script Date: 16/10/2018 11:13:37 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Subscription](
	[SubscriptionID] [int] IDENTITY(1,1) NOT NULL,
	[DistributorID] [int] NOT NULL,
	[SerialID] [int] NOT NULL,
	[Orders] [int] NOT NULL,
	[Cost] [int] NOT NULL,
	[NumberOfItemReceived] [int] NOT NULL,
	[Status] [varchar](50) NOT NULL,
	[Archive] [varchar](50) NULL,
	[IDD_Phase] [varchar](10) NULL,
	[InitialDeliveryDate] [date] NULL,
	[Subscription_Date] [date] NULL,
	[Subscription_End_Date] [date] NULL,
 CONSTRAINT [PK_Subscription] PRIMARY KEY CLUSTERED 
(
	[SubscriptionID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[Type]    Script Date: 16/10/2018 11:13:37 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Type](
	[TypeID] [int] IDENTITY(1,1) NOT NULL,
	[TypeName] [varchar](50) NOT NULL,
 CONSTRAINT [PK_Type] PRIMARY KEY CLUSTERED 
(
	[TypeID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[User]    Script Date: 16/10/2018 11:13:37 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[User](
	[UserID] [int] IDENTITY(1,1) NOT NULL,
	[UserName] [varchar](50) NOT NULL,
	[Password] [varchar](50) NOT NULL,
	[FirstName] [varchar](50) NOT NULL,
	[LastName] [varchar](50) NOT NULL,
	[Avatar] [varchar](50) NOT NULL,
	[Email] [varchar](50) NOT NULL,
	[Role] [varchar](25) NOT NULL,
	[DepartmentID] [varchar](10) NULL,
 CONSTRAINT [PK_User] PRIMARY KEY CLUSTERED 
(
	[UserID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
ALTER TABLE [dbo].[Categorize_Serials]  WITH CHECK ADD  CONSTRAINT [FK_Categorize_Serials_Department] FOREIGN KEY([DepartmentID])
REFERENCES [dbo].[Department] ([DepartmentID])
ON UPDATE CASCADE
GO
ALTER TABLE [dbo].[Categorize_Serials] CHECK CONSTRAINT [FK_Categorize_Serials_Department]
GO
ALTER TABLE [dbo].[Categorize_Serials]  WITH CHECK ADD  CONSTRAINT [FK_Categorize_Serials_Serial] FOREIGN KEY([SerialID])
REFERENCES [dbo].[Serial] ([SerialID])
ON UPDATE CASCADE
GO
ALTER TABLE [dbo].[Categorize_Serials] CHECK CONSTRAINT [FK_Categorize_Serials_Serial]
GO
ALTER TABLE [dbo].[Delivery]  WITH CHECK ADD  CONSTRAINT [FK_Delivery_Serial] FOREIGN KEY([SerialID])
REFERENCES [dbo].[Serial] ([SerialID])
ON UPDATE CASCADE
ON DELETE CASCADE
GO
ALTER TABLE [dbo].[Delivery] CHECK CONSTRAINT [FK_Delivery_Serial]
GO
ALTER TABLE [dbo].[Notification]  WITH CHECK ADD  CONSTRAINT [FK_Notification_Serial] FOREIGN KEY([SerialID])
REFERENCES [dbo].[Serial] ([SerialID])
ON UPDATE CASCADE
ON DELETE CASCADE
GO
ALTER TABLE [dbo].[Notification] CHECK CONSTRAINT [FK_Notification_Serial]
GO
ALTER TABLE [dbo].[ReceiveSerial]  WITH CHECK ADD  CONSTRAINT [FK_ReceiveSerial_Department] FOREIGN KEY([DepartmentID])
REFERENCES [dbo].[Department] ([DepartmentID])
ON UPDATE CASCADE
ON DELETE CASCADE
GO
ALTER TABLE [dbo].[ReceiveSerial] CHECK CONSTRAINT [FK_ReceiveSerial_Department]
GO
ALTER TABLE [dbo].[ReceiveSerial]  WITH CHECK ADD  CONSTRAINT [FK_ReceiveSerial_Serial] FOREIGN KEY([SerialID])
REFERENCES [dbo].[Serial] ([SerialID])
ON UPDATE CASCADE
ON DELETE CASCADE
GO
ALTER TABLE [dbo].[ReceiveSerial] CHECK CONSTRAINT [FK_ReceiveSerial_Serial]
GO
ALTER TABLE [dbo].[Serial]  WITH CHECK ADD  CONSTRAINT [FK_Serial_Type] FOREIGN KEY([TypeID])
REFERENCES [dbo].[Type] ([TypeID])
ON UPDATE CASCADE
ON DELETE SET NULL
GO
ALTER TABLE [dbo].[Serial] CHECK CONSTRAINT [FK_Serial_Type]
GO
ALTER TABLE [dbo].[Subscription]  WITH CHECK ADD  CONSTRAINT [FK_Subscription_Distributor] FOREIGN KEY([DistributorID])
REFERENCES [dbo].[Distributor] ([DistributorID])
ON UPDATE CASCADE
GO
ALTER TABLE [dbo].[Subscription] CHECK CONSTRAINT [FK_Subscription_Distributor]
GO
ALTER TABLE [dbo].[Subscription]  WITH CHECK ADD  CONSTRAINT [FK_Subscription_Serial] FOREIGN KEY([SerialID])
REFERENCES [dbo].[Serial] ([SerialID])
ON UPDATE CASCADE
GO
ALTER TABLE [dbo].[Subscription] CHECK CONSTRAINT [FK_Subscription_Serial]
GO
ALTER TABLE [dbo].[User]  WITH CHECK ADD  CONSTRAINT [FK_User_Department] FOREIGN KEY([DepartmentID])
REFERENCES [dbo].[Department] ([DepartmentID])
ON UPDATE CASCADE
ON DELETE SET NULL
GO
ALTER TABLE [dbo].[User] CHECK CONSTRAINT [FK_User_Department]
GO
